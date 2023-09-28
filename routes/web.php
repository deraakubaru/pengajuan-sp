<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\JadwalController;

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
    return view('login');
});

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('pages/profiles/index', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::get('dashboard/users/{id}/makeAdmin', [DashboardUserController::class, 'makeAdmin'])->middleware('auth');

Route::resource('pages/users', DashboardUserController::class)->middleware('auth');


Route::group(['middleware' => 'auth'], function ()
{
    Route::get('jadwal', function () {
        return view('jadwal.index');
    })->name('jadwal');

    Route::get('Pengumuman', function () {
        return view('pengumuman.index');
    })->name('Pengumuman');
    
    Route::get('user-management', [DashboardUserController::class, 'index'])->name('user-management');

    Route::get('/admin/user-profile', function () {
        return view('pages.profiles.index');
    })->name('user-profile');
});

Route::get('/', function () {return redirect('login');})->middleware('guest');
Route::get('jadwal', [JadwalController::class, 'index'])->middleware('auth')->name('jadwal');
Route::post('jadwal/add', [JadwalController::class, 'store'])->middleware('auth')->name('add-jadwal');
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('password.reset', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('pendaftaran', [PengajuanController::class, 'index'])->middleware('auth')->name('pengajuan');
Route::post('pendaftaran', [PengajuanController::class, 'store'])->middleware('auth')->name('ajukan');
Route::post('update-pendaftaran', [PengajuanController::class, 'update'])->middleware('auth')->name('update-pengajuan');
Route::delete('/semesterpendek/{id}', [PengajuanController::class, 'destroy'])->name('delete-sp');
Route::post('/semesterpendek/update/{id}', [PengajuanController::class, 'approve'])->name('approve');
Route::get('verify', function () {
    return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 

Route::resource('data-file', 'ImageController');