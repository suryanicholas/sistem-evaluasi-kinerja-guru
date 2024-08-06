<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherStoreRequest;
use App\Http\Requests\TeacherUpdateRequest;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.guru.index',[
            'title' => "Data Guru",
            'data' => Teacher::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.guru.create',[
            'title' => "Pendaftaran Guru Baru"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherStoreRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/Collections/', $imageName);
            $validated['image'] = $imageName;
        } else {
            $validated['image'] = null;
        }

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with(
            'response', [
                'type' => 'success',
                'message' => 'Data berhasil ditambahkan.'
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('dashboard.guru.show', [
            'title' => "Profil Guru",
            'gender' => [
                "male" => "Laki - Laki",
                "female" => "Perempuan"
            ],
            'data' => $teacher
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('dashboard.guru.edit', [
            'title' => 'Edit Profil Guru',
            'gender' => [
                "male" => true,
                "female" => false
            ],
            'data' => $teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeacherUpdateRequest $request, Teacher $teacher)
    {

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            Storage::delete('public/Collections/'. $teacher->image);
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/Collections/', $imageName);
            $validated['image'] = $imageName;
        }

        $teacher->update($validated);

        return redirect()->route('teachers.show', $teacher->code)->with(
            'response', [
                'type' => 'success',
                'message' => 'Perubahan disimpan!'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        if($teacher->image){
            Storage::delete('public/Collections/'.$teacher->image);
        }
        $teacher->delete();

        return redirect()->route('teachers.index')->with(
            'response',[
                'type' => 'success',
                'message' => 'Data telah dihapus!'
            ]
        );
    }

    /**
     * Search
     */
    public function search(Request $request){
        return Teacher::where('name', 'like', $request->search . '%')->limit(5)->select('code', 'name')->get();
    }
}
