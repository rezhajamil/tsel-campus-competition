<?php

use App\Models\Datadiri;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DatadiriController;
use App\Http\Controllers\IdeBisnisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/myproject', function () {
        return view('user.myproject.myproject');
    })->name('myproject');

    Route::get('/myproject/create-kelompok', function () {
        return view('user.myproject.create-kelompok');
    })->name('kelompok');

    Route::get('/edit-profile', function () {
        return view('user.datadiri.data-diri-edit');
    })->name('edit_profile');

    //dashboard

    //datadiri
    Route::get('/dashboard/data-diri', [DatadiriController::class, 'index'])->name('data-diri');
    Route::get('/data-diri/edit', [DatadiriController::class, 'index'])->name('data-diri-edit');
    Route::post('/dashboard/data-diri/edit', [DatadiriController::class, 'create'])->name('data-diri.update');

    //project
    Route::get('/myproject', [ProjectController::class, 'my_project'])->name('my_project');
    Route::get('/myproject/proposal/{id_proposal}', [PesertaController::class, 'index'])->name('model-bisnis');
    //kelompok
    Route::get('/create-project/kelompok', function () {
        return view('user.myproject.create-kelompok');
    })->name('nama_kelompok');

    Route::post('/create-project/create-kelompok', [ProjectController::class, 'create_kelompok'])->name('create_kelompok');

    //anggota
    Route::get('/myproject/anggota', [ProjectController::class, 'kelompok'])->name('anggota.add');
    Route::post('/myproject/create-anggota', [ProjectController::class, 'create_anggota'])->name('create_anggota');

    //proposal
    Route::get('/proposal/form-ide-bisnis', [ProjectController::class, 'ide_bisnis'])->name('ide-bisnis');
    Route::post('/proposal/form-ide-bisnis/input',[ProjectController::class, 'ide_bisnis_create'])->name('ide-bisnis.input');
    Route::get('/proposal/form-laba-rugi', [ProjectController::class, 'laba_rugi'])->name('laba-rugi');
    Route::post('/proposal/form-laba-rugi/input', [ProjectController::class, 'laba_rugi_create'])->name('laba-rugi.input');
    Route::get('/proposal/form-pemasaran', [ProjectController::class, 'pemasaran'])->name('pemasaran');
    Route::post('/proposal/form-pemasaran/input', [ProjectController::class, 'pemasaran_create'])->name('pemasaran.input');
    Route::get('/proposal/form-maintenance', [ProjectController::class, 'maintenance'])->name('maintenance');
    Route::post('/proposal/form-maintenance/input', [ProjectController::class, 'maintenance_create'])->name('maintenance.input');

    Route::get('/model-bisnis/create-tim', [PesertaController::class, 'index'])->name('create.index');

    Route::get('/get-kampus-by-keyword', [KampusController::class, 'getKampusByKeyword'])->name('get-kampus-by-keyword');
});

require __DIR__ . '/auth.php';
