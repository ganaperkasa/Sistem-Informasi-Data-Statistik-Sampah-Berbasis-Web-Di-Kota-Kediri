<?php

use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\TpsController;
use App\Models\Tps;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReduksiSampahController;
use App\Http\Controllers\WasteEntryController;
use App\Http\Controllers\WasteOutflowController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CobaController;

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
    return view('landingpage');
});

Route::get('/', [LandingpageController::class, 'index'])->name('landingpage');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


// Route::get('/login', function () {
//     return view('login.login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/maps', [PetaController::class, 'index'])->name('maps.index');
Route::get('/maps-tps', [LocationController::class, 'index'])->name('maps.index');
Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');

Route::get('/data-tps', [TpsController::class, 'index'])->name('tps.index');
Route::get('/tps/edit/{id}', [TpsController::class, 'edit'])->name('tps.edit');
Route::post('/tps/store', [TpsController::class, 'store'])->name('tps.store');
Route::put('/tps/update/{id}', [TpsController::class, 'update'])->name('tps.update');
Route::delete('/tps/delete/{id}', [TpsController::class, 'destroy'])->name('tps.destroy');

//route index reduksisampah
Route::get('/reduksi-sampah', [ReduksiSampahController::class, 'index'])->name('reduksi_sampah.index');
Route::get('/reduksi-sampah/create', [ReduksiSampahController::class, 'create'])->name('reduksi_sampah.create');
Route::post('/reduksi-sampah/hitung', [ReduksiSampahController::class, 'hitungDanSimpan'])->name('reduksi_sampah.calculate');

Route::get('/waste-entries', [WasteEntryController::class, 'index'])->name('waste_entries.index');
Route::get('/waste-entries/create', [WasteEntryController::class, 'create'])->name('waste_entries.create');
Route::post('/waste-entries', [WasteEntryController::class, 'store'])->name('waste_entries.store');

Route::get('/waste-outflows', [WasteOutflowController::class, 'index'])->name('waste_outflows.index');
Route::get('/waste-outflows/create', [WasteOutflowController::class, 'create'])->name('waste_outflows.create');
Route::post('/waste-outflows', [WasteOutflowController::class, 'store'])->name('waste_outflows.store');

// Route::post('/reduksi-sampah/calculate', [ReduksiSampahController::class, 'calculate'])->name('reduksi_sampah.calculate');
