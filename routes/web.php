<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            
use App\Http\Controllers\AbsensiController;            
use App\Http\Controllers\ManajemenKasController;            
use App\Http\Controllers\EventsController;  
use App\Http\Controllers\AnggotaController;  
          
            

Route::get('/', function () {return redirect('/dashboard');
})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

	Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
	Route::get('/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('login.google.callback');

	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	//anggota
	Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota');
	Route::get('anggota/tambah', [AnggotaController::class, 'addanggota'])->name('tambah-anggota');
	Route::post('post-anggota', [AnggotaController::class, 'postanggota'])->name('post-anggota');
	
	Route::get('/edit-anggota/{id_siswa}', [AnggotaController::class, 'editanggota'])->name('edit-anggota');
	Route::post('/update-anggota/{id_siswa}', [AnggotaController::class, 'updateanggota'])->name('update-anggota');
	Route::get('/delete-anggota/{id_siswa}', [AnggotaController::class, 'deleteanggota'])->name('delete-anggota');

	//generate-qr
	Route::get('anggota/generate-qr', [AnggotaController::class, 'generateQRCode'])->name('generate-qr');

	//absensi
	Route::post('sesi-absensi}', [AbsensiController::class, 'sesiAbsensi'])->name('sesi-absensi');
	Route::get('absen-scan/{id_sesi}', [AbsensiController::class, 'scanAbsen'])->name('absen-scan');
	Route::get('update-absen-scan/{id_sesi}', [AbsensiController::class, 'scanUpdate'])->name('update-absen-scan');
	Route::get('/delete-sesi/{id_sesi}', [AbsensiController::class, 'deleteSesi'])->name('delete-sesi');

	Route::post('process-presensi/{id_sesi}', [AbsensiController::class, 'processPresensi'])->name('process-presensi');
	Route::get('/detail-absen/{id_sesi}', [AbsensiController::class, 'detailAbsen'])->name('detail-absen');

	//events
	Route::get('events/list', [EventsController::class, 'listEvent'])->name('events.list');
	Route::resource('events', EventsController::class)->names([
		'index' => 'events.index',
		'create' => 'events.create',
		'store' => 'events.store',
		'show' => 'events.show',
		'edit' => 'events.edit',
		'update' => 'events.update',
		'destroy' => 'events.destroy'
	]);

	//pages
	Route::get('/absensi', [AbsensiController::class, 'show'])->name('absensi');
	Route::get('/manajemen_kas', [ManajemenKasController::class, 'show'])->name('manajemen_kas');
	
	Route::get('/scan', [ScanController::class, 'scanabsen'])->name('scan');
});

Route::get('absensi/qrcode', [AbsensiController::class, 'qrcode'])->name('qr-code');