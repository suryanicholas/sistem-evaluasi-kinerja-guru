<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;

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
    public function store(StoreEvaluationRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
