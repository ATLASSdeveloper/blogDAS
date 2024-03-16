<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;

Route::get('/', [BlogController::class, 'cargarDatos'])->name('cargarDatos');
Route::get('/formulario', function () {
    return view('formBlog');
})->name('obtenerFormulario');

Route::post('/formulario', [BlogController::class, 'guardar'])->name('guardar');

