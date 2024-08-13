<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Question;
use App\Models\Response;
use App\Models\Evaluation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.evaluasi.index', [
            'title' => 'Kelola Evalausi',
            'data' => Evaluation::orderBy('created_at', 'desc')->paginate('20')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.evaluasi.create', [
            'title' => "Evaluasi Baru"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $i = Carbon::now()->format('YmdHis');
        Evaluation::create([
            'slug' => "evaluasi-baru-$i"
        ]);
        Segment::create([
            'evaluation_id' => Evaluation::where('slug', "evaluasi-baru-$i")->first()->id,
            'index' => 1,
            'label' => "Bagian 1"
        ]);
        Question::create([
            'segment_id' => Evaluation::where('slug', "evaluasi-baru-$i")->first()->segments->first()->id,
            'index' => 1
        ]);
        return redirect()->route('evaluations.edit', "evaluasi-baru-$i")->with(
            'response', [
                'type' => "success",
                'message' => "Evaluasi baru dibuat."
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        return view('dashboard.evaluasi.show', [
            'title' => 'Statistik Evaluasi',
            'data' => $evaluation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        return view('dashboard.evaluasi.edit', [
            'title' => 'Edit Evaluasi',
            'data' => $evaluation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        /**
         * Evaluations
         */
        $validating = Validator::make($request->all(),[
            'title' => ['required', 'max:120'],
            'description' => ['required', 'max:1200'],
            'periode.start' => ['required', 'date'],
            'periode.end' => ['required', 'date']
        ], [
            'title.required' => "Judul tidak boleh kosong!",
            'description.required' => "Deskripsi tidak boleh kosong!",
            'title.max' => "Judul melebihi batas! 120",
            'description.max' => "Deskripsi melebihi batas! 1200",
            'periode.start.required' => "Tanggal Dimulai tidak boleh kosong!",
            'periode.end.required' => "Tanggal Berakhir tidak boleh kosong!",
            'periode.start.date' => "Tanggal Dimulai tidak valid!",
            'periode.end.date' => "Tanggal Berakhir tidak valid!",
        ]);

        if($validating->fails()){
            return response([
                'status' => 422,
                'errors' => $validating->errors()
            ]);
        }
        $request['periode'] = json_encode($request->periode);
        $evaluation->fill([
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'periode' => $request->periode
        ]);
        $evaluation->save();

        /**
         * Segments
         */
        if(isset($request['segments'])){
            $iteration = 0;
            foreach($request->segments as $item){

                if($evaluation->segments()->where('index', $item['index'])->count()){
                    $segment = $evaluation->segments()->where('index', $item['index'])->first();
                    $segment->fill([
                        'index' => $item['index'],
                        'label' => $item['label']
                    ]);
                    $segment->save();
                } else{
                    $segment = $evaluation->segments()->create([
                        'index' => $item['index'],
                        'label' => $item['label'],
                    ]);

                }

                if(isset($item['questions'])){
                    foreach($item['questions'] as $itemQuest){

                        if($segment->question()->where('index', $itemQuest['index'])->count()){
                            $question = $segment->question()->where('index', $itemQuest['index'])->first();
                            $question->fill([
                                'index' => $itemQuest['index'],
                                'question' => $itemQuest['question'],
                            ]);
                            $question->save();
                        } else{
                            $question = $segment->question()->create([
                                'index' => $itemQuest['index'],
                                'question' => $itemQuest['question'],
                            ]);
                        }
                    }
                    $qa = $segment->question()->count();
                    $qb = count($request->segments[$iteration]['questions']);
                    if($qa > $qb){
                        $segment->question()->where('index', '>', $qb)->delete();
                    }
                } else{
                    $segment->question()->delete();
                }
                $iteration++;
            }

            $sa = $evaluation->segments()->count();
            $sb = count($request->segments);
            if($sa > $sb){
                $evaluation->segments()->where('index', '>', $sb)->delete();
            }

        } else{
            $evaluation->segments()->delete();
        }

        

        return response([
            'status' => 200,
            'message' => 'Perubahan telah disimpan'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('evaluations.index')->with(
            'response', [
                'type' => 'success',
                'message' => "$evaluation->title telah dihapus!"
            ]
        );
    }

    /**
     * 
     */
    public function evaluateVerify(Evaluation $evaluation)
    {   
        if(session()->has($evaluation->slug)){
            $respondent = $evaluation->respondent->where('token', session($evaluation->slug))->first();
            if($respondent){
                return redirect()->route('evaluate.start', [$evaluation->slug, $respondent->token]);
            }
        }

        return view('public.auth', [
            'title' => $evaluation->title,
            'data' => $evaluation
        ]);
    }

    public function evaluateAuth(Evaluation $evaluation, Request $request)
    {

        // Memeriksa tipe dari Nomor Identitas Calon Responden
        if($request->type === "student"){
            $student = Student::where('code', $request->identify)->first();
            // Memeriksa apakah Siswa dengan Nomor Identitas tersebut ada
            if($student){

                $respondent = $evaluation->respondent()->where('respondent', $student->id)->first();

                if($respondent === null){
                    $respondent = Response::create([
                        'token' => Str::random(64),
                        'evaluation_id' => $evaluation->id,
                        'type' => $request->type,
                        'respondent' => $student->id
                    ]);
                }

                session(["$evaluation->slug" => $respondent->token]);

                return redirect()->route('evaluate.index', $evaluation->slug)->with(
                    'response', [
                        'type' => 'success',
                        'message' => 'Identified'
                    ]
                );
            }
        } elseif($request->type === "teacher"){

            // Memeriksa apakah Guru dengan Nomor Identitas tersebut ada
            if(Teacher::where('code', $request->identify)->count()){
                $respondent = Response::create([
                    'token' => Str::random(64),
                    'evaluation_id' => $evaluation->id,
                    'type' => $request->type,
                    'respondent' => Teacher::where('code', $request->identify)->first()->id
                ]);

                session(["$evaluation->slug" => $respondent->token]);
                
                return redirect()->route('evaluate.index', $evaluation->slug)->with(
                    'response', [
                        'type' => 'success',
                        'message' => 'Identified'
                    ]
                );
            }
        }
        return redirect()->to("#identifyForm")->with(
            'response', [
                'type' => 'danger',
                'message' => 'Kami tidak menemukan informasi tentang anda!'
            ]
        );
    }

    public function evaluateStart(Evaluation $evaluation, Response $respondent)
    {
        if(session()->missing($evaluation->slug)){
            return redirect()->route('evaluate.index', $evaluation->slug);
        }

        return view('public.evaluate', [
            'title' => $evaluation->title,
            'data' => $evaluation,
            'respondent' => $respondent
        ]);
    }

    public function evaluateEnd(Evaluation $evaluation)
    {
        if(session()->has($evaluation->slug)){
            session()->forget($evaluation->slug);
        }

        return redirect()->route('evaluate.verify', $evaluation->slug);
    }
}