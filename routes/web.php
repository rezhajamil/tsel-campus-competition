<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DatadiriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Admin\ProposalController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\PesertaControllerAdmin;
use App\Http\Controllers\PrefixController;

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
Route::get('/schools', [SchoolController::class, 'index']);

Route::get('/api/telkomsel-prefixes', [PrefixController::class, 'getTelkomselPrefixes']);


Route::get('notif-list', function () {
    auth()->user()->notifications->markAsRead();
    return redirect()->back();
})->name('notif.list');


Route::group(['middleware' => ['auth', 'checkRole:admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard-admin', function () {
        return view('dashboard-admin');
    })->name('dashboard-admin');

    Route::get('/dashboard-admin2', [PendaftaranController::class, 'index'])->name('dashboard-admin2');

    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Peserta Routes
    Route::get('/pesertas', [PesertaControllerAdmin::class, 'index'])->name('admin.Pesertas.index');
    Route::get('/pesertas/create', [PesertaControllerAdmin::class, 'create'])->name('admin.Pesertas.create');
    Route::post('/pesertas', [PesertaControllerAdmin::class, 'store'])->name('admin.Pesertas.store');
    Route::get('/pesertas/{peserta}', [PesertaControllerAdmin::class, 'show'])->name('admin.Pesertas.show');
    Route::get('/pesertas/{peserta}/edit', [PesertaControllerAdmin::class, 'edit'])->name('admin.Pesertas.edit');
    Route::put('/pesertas/{peserta}', [PesertaControllerAdmin::class, 'update'])->name('admin.Pesertas.update');
    Route::delete('/pesertas/{peserta}', [PesertaControllerAdmin::class, 'destroy'])->name('admin.Pesertas.destroy');

    Route::get('/proposals', [ProposalController::class, 'index'])->name('admin.proposals.index');
    Route::get('/proposals/create', [ProposalController::class, 'create'])->name('admin.proposals.create');
    Route::post('/proposals', [ProposalController::class, 'store'])->name('admin.proposals.store');
    Route::get('/proposals/{proposal}', [ProposalController::class, 'show'])->name('admin.proposals.show');
    Route::get('/proposals/{proposal}/edit', [ProposalController::class, 'edit'])->name('admin.proposals.edit');
    Route::put('/proposals/{proposal}', [ProposalController::class, 'update'])->name('admin.proposals.update');
    Route::delete('/proposals/{proposal}', [ProposalController::class, 'destroy'])->name('admin.proposals.destroy');
    Route::get('/proposals/{proposal}/approve', [ProposalController::class, 'approve'])->name('admin.proposals.approve');
    Route::put('/proposals/{proposal}/approve', [ProposalController::class, 'updateStatus'])->name('admin.proposals.updateStatus');


    Route::get('/pendaftarans', [PendaftaranController::class, 'index'])->name('dashboard-admin');
    Route::get('/pendaftarans/create', [PendaftaranController::class, 'create'])->name('admin.pendaftarans.create');
    Route::post('/pendaftarans', [PendaftaranController::class, 'store'])->name('admin.pendaftarans.store');
    Route::get('/pendaftarans/{pendaftaran}', [PendaftaranController::class, 'show'])->name('admin.pendaftarans.show');
    Route::get('/pendaftarans/{pendaftaran}/edit', [PendaftaranController::class, 'edit'])->name('admin.pendaftarans.edit');
    Route::put('/pendaftarans/{pendaftaran}', [PendaftaranController::class, 'update'])->name('admin.pendaftarans.update');
    Route::delete('/pendaftarans/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('admin.pendaftarans.destroy');



    Route::get('/timelines', [TimelineController::class, 'index'])->name('admin.timelines.index');
    Route::get('/timelines/create', [TimelineController::class, 'create'])->name('admin.timelines.create');
    Route::post('/timelines', [TimelineController::class, 'store'])->name('admin.timelines.store');
    Route::get('/timelines/{timeline}', [TimelineController::class, 'show'])->name('admin.timelines.show');
    Route::get('/timelines/{timeline}/edit', [TimelineController::class, 'edit'])->name('admin.timelines.edit');
    Route::put('/timelines/{timeline}', [TimelineController::class, 'update'])->name('admin.timelines.update');
    Route::delete('/timelines/{timeline}', [TimelineController::class, 'destroy'])->name('admin.timelines.destroy');
});


Route::group(['middleware' => ['auth', 'checkRole:Peserta'], 'prefix' => 'Peserta'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //datadiri
    Route::get('/dashboard/data-diri', [DashboardController::class, 'datadiri'])->name('data-diri');
    Route::get('/data-diri/edit', [DashboardController::class, 'datadiri'])->name('data-diri-edit');
    Route::post('/dashboard/data-diri/edit', [DatadiriController::class, 'create'])->name('data-diri.update');
    Route::get('/get-kampus-by-keyword', [KampusController::class, 'getKampusByKeyword'])->name('get-kampus-by-keyword');

    Route::middleware(['verified'])->group(function () {
        Route::get('/myproject/create-kelompok', [DashboardController::class, 'kelompok'])->name('kelompok');

        //project
        Route::get('/myproject', [DashboardController::class, 'my_project'])->name('my_project');
        Route::get('/myproject/proposal/{proposal_id}', [PesertaController::class, 'index'])->name('model-bisnis');
        Route::post('/myproject/publish', [ProjectController::class, 'publish'])->name('publish');

        //kelompok
        Route::get('/create-project/kelompok', [ProjectController::class, 'nama_kelompok'])->name('nama_kelompok');
        Route::post('/create-project/create-kelompok', [ProjectController::class, 'create_kelompok'])->name('create_kelompok');

        //anggota
        Route::get('/myproject/anggota', [ProjectController::class, 'kelompok'])->name('anggota.add');
        Route::post('/myproject/create-anggota', [ProjectController::class, 'create_anggota'])->name('create_anggota');

        //proposal
        Route::get('/proposal/form-ide-bisnis', [ProjectController::class, 'ide_bisnis'])->name('ide-bisnis');
        Route::post('/proposal/form-ide-bisnis/input/{proposal_id}', [ProjectController::class, 'ide_bisnis_create'])->name('ide-bisnis.input');
        Route::get('/proposal/form-laba-rugi', [ProjectController::class, 'laba_rugi'])->name('laba-rugi');
        Route::post('/proposal/form-laba-rugi/input/{proposal_id}', [ProjectController::class, 'laba_rugi_create'])->name('laba-rugi.input');
        Route::get('/proposal/form-pemasaran', [ProjectController::class, 'pemasaran'])->name('pemasaran');
        Route::post('/proposal/form-pemasaran/input/{proposal_id}', [ProjectController::class, 'pemasaran_create'])->name('pemasaran.input');
        Route::get('/proposal/form-maintenance', [ProjectController::class, 'maintenance'])->name('maintenance');
        Route::post('/proposal/form-maintenance/input/{proposal_id}', [ProjectController::class, 'maintenance_create'])->name('maintenance.input');

        Route::get('/model-bisnis/create-tim', [PesertaController::class, 'index'])->name('create.index');
    });
});

require __DIR__ . '/auth.php';
