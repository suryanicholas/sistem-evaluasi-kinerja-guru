<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Room;
use App\Models\Student;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboard.index',[
            'title' => 'Dashboard',
            'data' => [
                'siswa' => Student::count(),
                'guru' => Teacher::count(),
                'kelas' => Room::count()
            ],
            'evaluations' => Evaluation::limit(10)->get()
        ]);
    }
}