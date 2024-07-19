<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.index',[
        'title' => 'SDN1068212 Bandar Baru'
    ]);
});

require __DIR__.'/auth.php';