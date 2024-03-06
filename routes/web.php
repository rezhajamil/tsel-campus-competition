<?php

use App\Models\User;
use App\Models\UserOTP;
use App\Models\Datadiri;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\KampusController;
use App\Notifications\SendOTPNotification;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DatadiriController;
use App\Http\Controllers\DashboardController;
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
Route::get('/{user_id}/otp-verification', function ($user_id) {
    $user = User::find($user_id);
    return view('otp', compact('user'));
})->name('otp-verification');

Route::post('/{user_id}/otp-verification/resend-otp', function ($user_id) {

    $otp = UserOTP::where('user_id', $user_id)->first();
    $otp->otp_code = rand(100000, 999999);
    $otp->expired_at = Date::now()->addMinutes(5);
    $otp->save();
    $otp->user->notify(new SendOTPNotification($otp->otp_code));
    return redirect()->route('otp-verification', $otp->user_id);
})->name('resend-otp');

Route::post('/{user_id}/otp-validation', function ($user_id, Request $request) {
    $otp = UserOTP::where('otp_code', $request->otp_code)->where('expired_at', '>', now())->first();
    if (!$otp) {
        return back()->withErrors(
            'otp_code',
            'OTP CODE tidak ditemukan.'
        );
    }
    $otp->user->email_verified_at = Date::now();
    $otp->user->save();
    Auth::login($otp->user);
    return redirect(RouteServiceProvider::HOME);
})->name('otp.validation');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::post('/myproject/publish', [ProjectController::class, 'publish'])->name('publish');

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
    Route::post('/proposal/form-ide-bisnis/input', [ProjectController::class, 'ide_bisnis_create'])->name('ide-bisnis.input');
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
