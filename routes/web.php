<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('logout',[AuthController::class,'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function() {
    Route::get('doctors', [DoctorController::class,'index'])->name('doctors');
    Route::get('export-doctors', [DoctorController::class, 'export'])->name('export-doctors');
});

Route::get('doctors/form',[DoctorController::class,'doctorsForm'])->name('doctors.form');
Route::post('doctors/form/save',[DoctorController::class,'doctorSave'])->name('doctors.form.save');
Route::get('dowload/{doctor_id}',[DoctorController::class,'download'])->name('download');