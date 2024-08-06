<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.index', [
            'title' => "Akses Sistem",
            'data' => User::whereNotIn('id', [Auth::id()])->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('auth.show', [
            'title' => "Pengaturan Pengguna",
            'data' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
