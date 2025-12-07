<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/admin', function () {
    return Inertia::render('Admin/Dashboard');
});


Route::get('/', function () {
    return view('welcome');
});
