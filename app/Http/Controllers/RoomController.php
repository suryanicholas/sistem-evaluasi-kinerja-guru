<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomStoreRequest;
use App\Models\Room;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.kelas.index', [
            "title" => "Data Kelas",
            "data" => Room::orderBy('created_at', 'desc')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.kelas.create', [
           'title' => "Buat Kelas Baru",
           'teachers' => Teacher::limit(10)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request)
    {
        $validated = $request->validated();

        $validated['code'] = Carbon::now()->format('YmdHis') . mt_rand(1000, 9999);
        $validated['teacher_id'] = Teacher::where('code', $validated['teacher'])->first()->id;
        unset($validated['teacher']);

        Room::create($validated);

        return redirect()->route('rooms.index')->with(
            'response',[
                'type' => "success",
                'message' => "Kelas baru telah ditambahkan."
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('dashboard.kelas.show', [
            'title' => "Profil Kelas",
            'data' => $room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('dashboard.kelas.edit', [
            "title" => "Ubah Informasi Kelas",
            "data" => $room,
            'teachers' => Teacher::limit(10)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request['teacher'] = Teacher::where('code', $request['teacher'])->first()->id;

        $validated = $request->validate([
            'name' => "required",
            'teacher' => "required|unique:rooms,teacher_id,".$room->id
        ], [
            'teacher.unique' => "Guru ini telah menjadi Wali Kelas lain."
        ]);

        $validated['teacher_id'] = $validated['teacher'];
        unset($validated['teacher']);

        $room->update($validated);

        return redirect()->route('rooms.show', $room->code)->with([
            'response', [
                'type' => 'success',
                'message' => 'Perubahan telah disimpan.'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with(
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
        return Room::where('name', 'like', $request->search . '%')->limit(5)->select('code', 'name')->get();
    }
}
