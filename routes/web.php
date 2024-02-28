<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\DatadiriController;
use App\Http\Controllers\ProjectController;
use App\Models\Datadiri;

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



Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/myproject', function () {
        return view('user.myproject.myproject');
    })->name('myproject');

    Route::get('/myproject/create-kelompok', function(){
        return view('user.myproject.create-kelompok');
    })->name('kelompok');

    Route::get('/edit-profile', function(){
        return view('user.datadiri.data-diri-edit');
    })->name('edit_profile');

    //dashboard

    //datadiri
    Route::get('/dashboard/data-diri', [DatadiriController::class, 'index'])->name('data-diri');
    Route::get('/data-diri/edit', [DatadiriController::class,'index'])->name('data-diri-edit');
    Route::post('/dashboard/data-diri/edit', [DatadiriController::class, 'create'])->name('data-diri.update');

    //project
    Route::get('/myproject', [ProjectController::class,'view_all'])->name('view_all');
        //kelompok
        Route::get('/create-project/kelompok', function(){
            return view('user.myproject.create-kelompok');
        })->name('nama_kelompok');

        Route::post('/create-project/create-kelompok', [ProjectController::class,'create_kelompok'])->name('create_kelompok');
        //Team
        Route::post('/myproject/create-anggota', [ProjectController::class, 'create_anggota'])->name('create_anggota');
        //proposal

    Route::get('/model-bisnis/create-tim',[PesertaController::class, 'index'])->name('create.index');
    Route::get('/dashboard/model-bisnis',[PesertaController::class, 'index'])->name('peserta.index');
    Route::get('/get-kampus-by-keyword', [KampusController::class, 'getKampusByKeyword'])->name('get-kampus-by-keyword');
});

require __DIR__.'/auth.php';
