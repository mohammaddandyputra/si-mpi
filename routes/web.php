<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\KomponenController;
use App\Http\Controllers\GangguanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\TerasController;
use App\Http\Controllers\MpiController;
use App\Http\Controllers\ScrController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\RelasiKomponenController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', UserController::class);

// Komponen
Route::resource('komponen', KomponenController::class);

// Gangguan
Route::resource('gangguan', GangguanController::class);
// Route::get('/search-komponen', [GangguanController::class, 'searchDataKomponen']);
// Route::get('/search-teras', [GangguanController::class, 'searchDataTeras']);

//Gangguan Teras
Route::get('/history-gangguan/teras', [GangguanController::class, 'historyGangguanTeras'])->name('history-teras');
Route::get('/history-gangguan/teras/{id_teras}/komponen', [GangguanController::class, 'historyGangguanTerasKomponen']);
Route::get('/history-gangguan/teras/{id_teras}/komponen/{id_komponen_teras}', [GangguanController::class, 'historyGangguanTerasKomponenDetail']);

//Gangguan Komponen
Route::get('/history-gangguan/komponen', [GangguanController::class, 'historyGangguanKomponen'])->name('history-komponen');
Route::get('/history-gangguan/komponen/{kode_komponen}', [GangguanController::class, 'historyGangguanKomponenDetail']);

// Perbaikan
Route::resource('perbaikan', PerbaikanController::class);
Route::post('/perbaikan/{id}', [PerbaikanController::class, 'updateGangguan'])->name('perbaikan.updateGangguan');
// Route::get('/search-gangguan', [PerbaikanController::class, 'searchDataGangguan']);

// Teras
Route::resource('teras', TerasController::class);
Route::get('data/teras', [TerasController::class, 'getTeras'])->name('data-teras');

//Relasi
Route::resource('relasi-komponen', RelasiKomponenController::class);

//SCR
Route::get('/scr', [ScrController::class, 'index'])->name('scr.index');
Route::get('/scr/create', [ScrController::class, 'create'])->name('scr.create');
Route::post('/scr', [ScrController::class, 'store'])->name('scr.store');
Route::get('/scr/{id}/edit', [ScrController::class, 'edit'])->name('scr.edit');
Route::post('/scr/{id}', [ScrController::class, 'update'])->name('scr.update');

//MPI
Route::get('mpi', [MpiController::class, 'index'])->name('mpi.index');

//Grafik
Route::get('grafik', [GrafikController::class, 'index'])->name('grafik-mpi');