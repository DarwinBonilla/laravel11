<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\RegistroSoporteController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\GraficoRegistrosController;




Route::get('/', function () {
    return redirect()->route('mostrar.datos');
})->name('home');



Route::get('/Formulario-Soporte', [MyController::class, 'mostrarDatos'])->name('mostrar.datos');

//NUEVO CONTROLADOR
Route::post('/Formulario-Soporte', [RegistroSoporteController::class, 'store'])->name('registro.soporte.store');

Route::get('/formulario-enviado', function () {
    return view('welcome');
})->name('welcome');


//VISTA PDF
Route::get('/pdf', [RegistroSoporteController::class, 'mostrarPDF'])->name('pdf.mostrar');

Route::get('/grafico-registros', [GraficoRegistrosController::class, 'index'])->name('grafico.registros');

Route::get('/registro-soporte/create', [RegistroSoporteController::class, 'create'])->name('registro.soporte.create');