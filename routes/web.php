<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\RoleMiddleware;


// Route untuk halaman utama    



Route::get('/', function () {
    return view('landing');
});

// Reservasi
Route::prefix('reservasi')->name('reservasi.')->group(function () {
    Route::get('/', [ReservasiController::class, 'index'])->name('index');
    Route::get('/create', [ReservasiController::class, 'create'])->name('create');
    Route::post('/', [ReservasiController::class, 'store'])->name('store');
    Route::get('/{reservasi}/edit', [ReservasiController::class, 'edit'])->name('edit');
    Route::put('/{reservasi}', [ReservasiController::class, 'update'])->name('update');
    Route::delete('/{reservasi}', [ReservasiController::class, 'destroy'])->name('destroy');


    // DataTables route
    Route::get('/datatable', [ReservasiController::class, 'datatables'])->name('datatable');
});


//landing
Route::get('/', [LandingPageController::class, 'index'])->name('landing');


//rom
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
Route::post('/rooms/{id}/upload-image', [RoomController::class, 'uploadImage'])->name('rooms.uploadImage');
Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
Route::patch('/rooms/{id}/toggle-status', [RoomController::class, 'toggleStatus'])->name('rooms.toggleStatus');
Route::get('/reservasi/datatables', [ReservasiController::class, 'getData'])->name('reservasi.datatables');
Route::resource('reservasi', ReservasiController::class);
Route::post('/reservasi/{reservasi}/approve', [ReservasiController::class, 'approve'])
    ->name('reservasi.approve');

// Route tambahan khusus
Route::get('/rooms/search', [RoomController::class, 'search'])->name('rooms.search');


//login
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'create'])->name('login');  

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route yang hanya bisa diakses oleh admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/reservasi/create', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
});

// Router user masukin dibawah ini
Route::middleware(['auth'])->group(function () {
    // reservasi atau mendaftar 
    Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
    Route::get('/reservasi/create', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
    Route::get('/reservasi/{reservasi}/edit', [ReservasiController::class, 'edit'])->name('reservasi.edit');
    Route::put('/reservasi/{reservasi}', [ReservasiController::class, 'update'])->name('reservasi.update');
    Route::delete('/reservasi/{reservasi}', [ReservasiController::class, 'destroy'])->name('reservasi.destroy');
    Route::get('/reservasi/datatables', [ReservasiController::class, 'getData'])->name('reservasi.datatables');
});


// Route untuk halamaman admin
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('rooms', RoomController::class);
    Route::get('/reservasi/datatables', [ReservasiController::class, 'getData'])->name('reservasi.datatables');
});
//route ketika user mengeklik tombol pesan setelah login menuju create reservasi
Route::middleware(['auth'])->group(function () { 
    Route::get('/reservasi/create', [ReservasiController::class, 'create'])->name('reservasi.create');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');
});