<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.siswa.index', [
            "title" => "Data Siswa",
            "data" => Student::orderBy('created_at', 'desc')->paginate(),
            'gender' => [
                'male' => "Laki - Laki",
                "female" => "Perempuan"
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.siswa.create', [
            'title' => "Pendaftaran Siswa Baru",
            'rooms' => Room::limit(5)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentStoreRequest $request)
    {
        $validated = $request->validated();

        $validated['birth'] = [
            'place' => $validated['birthPlace'],
            'date' => $validated['birthDate']
        ];
        unset($validated['birthPlace']);
        unset($validated['birthDate']);

        $validated['room_id'] = Room::where('code', $validated['room'])->first()->id;
        unset($validated['room']);

        $validated['parents'] = [
            'father' => [
                'name' => $validated['fatherName'],
                'occupation' => $validated['fatherJob']
            ],
            'mother' => [
                'name' => $validated['motherName'],
                'occupation' => $validated['motherJob']
            ],
            'contact' => $validated['phone'],
            'guardian' => $validated['wali'] ? $validated['wali'] : null
        ];
        unset($validated['fatherName']);
        unset($validated['fatherJob']);
        unset($validated['motherName']);
        unset($validated['motherJob']);
        unset( $validated['phone']);
        unset( $validated['wali']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/Collections/', $imageName);
            $validated['image'] = $imageName;
        } else {
            $validated['image'] = null;
        }

        Student::create($validated);

        return redirect()->route('students.index')->with(
            'response', [
                'type' => 'success',
                'message' => 'Siswa baru telah ditambahkan.'
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('dashboard.siswa.show', [
            'title' => "Profil Siswa",
            'data' => $student,
            'gender' => [
                'male' => "Laki - Laki",
                "female" => "Perempuan"
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('dashboard.siswa.edit', [
            'title' => "Ubah Informasi Siswa",
            'data' => $student,
            'rooms' => Room::limit(5)->get(),
            'gender' => [
                'male' => "Laki - Laki",
                "female" => "Perempuan"
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'code' => "required|unique:students,code,$student->id",
            'name' => "required|max:120",
            'gender' => "required",
            'birthPlace' => "required|max:50",
            'birthDate' => "required|date",
            'room' => 'required',
            'fatherName' => 'required|max:120',
            'motherName' => 'required|max:120',
            'fatherJob' => 'required|max:120',
            'motherJob' => 'required|max:120',
            'wali' => 'nullable|max:120',
            'phone' => 'required|numeric',
            'address' => 'required|max:120',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ],[
            '*.required' => "Mohon mengisi bagian ini.",
            'code.unique' => "NISN ini telah digunakan",
            'name.max' => "Maksimal 120 Karakter",
            'birthPlace.max' => "Maksimal 50 Karakter",
            'birthDate.date' => "Tanggal tidak valid",
            'birthDate.before_or_equal' => "Mohon mengisi Tanggal yang valid.",
            'fatherName.max' => "Maksimal 120 Karakter",
            'motherName.max' => "Maksimal 120 Karakter",
            'fatherJob.max' => "Maksimal 120 Karakter",
            'motherJob.max' => "Maksimal 120 Karakter",
            'wali.max' => "Maksimal 120 Karakter",
            'phone.numeric' => "Gunakan angka 0-9.",
            'address.max' => "Maksimal 120 Karakter",
            'image.image' => "Pilih gambar yang valid (Max. 2MB). Format: .JPG, .JPEG, .PNG",
            'image.mimes' => "Pilih gambar yang valid (Max. 2MB). Format: .JPG, .JPEG, .PNG",
            'image.max' => "Gambar yang anda pilih melebihi Batas Maksimum"
        ]);

        $validated['birth'] = [
            'place' => $validated['birthPlace'],
            'date' => $validated['birthDate']
        ];
        unset($validated['birthPlace']);
        unset($validated['birthDate']);

        $validated['room_id'] = Room::where('code', $validated['room'])->first()->id;
        unset($validated['room']);

        $validated['parents'] = [
            'father' => [
                'name' => $validated['fatherName'],
                'occupation' => $validated['fatherJob']
            ],
            'mother' => [
                'name' => $validated['motherName'],
                'occupation' => $validated['motherJob']
            ],
            'contact' => $validated['phone'],
            'guardian' => $validated['wali'] ? $validated['wali'] : null
        ];
        unset($validated['fatherName']);
        unset($validated['fatherJob']);
        unset($validated['motherName']);
        unset($validated['motherJob']);
        unset( $validated['phone']);
        unset( $validated['wali']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            Storage::delete('public/Collections/'. $student->image);
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/Collections/', $imageName);
            $validated['image'] = $imageName;
        }

        $student->update($validated);

        return redirect()->route('students.show', $student->code)->with(
            'response', [
                'type' => 'success',
                'message' => 'Perubahan telah disimpan'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if($student->image){
            Storage::delete('public/Collections/'. $student->image);
        }
        $student->delete();
        return redirect()->route('students.index')->with(
            'response',[
                'type' => "success",
                'message' => "Data telah dihapus."
            ]
        );
    }
}
