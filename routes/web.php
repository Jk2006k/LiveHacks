<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Laravel is running correctly!',
        'timestamp' => now()
    ]);
});

Route::get('/about',function(){
    return view('about');
});


Route::get('/contact',function(){
    return view('contact');
});