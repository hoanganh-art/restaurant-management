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
    return view('dashboard');
});

// Quản lý hóa đơn
Route::resource('hoa-don', HoaDonController::class);
Route::post('hoa-don/{id}/thanh-toan', [HoaDonController::class, 'thanhToan'])->name('hoa-don.thanh-toan');
Route::get('hoa-don/thong-ke', [HoaDonController::class, 'thongKe'])->name('hoa-don.thong-ke');

// Quản lý bàn ăn
Route::resource('ban-an', BanAnController::class);
Route::post('ban-an/{id}/trang-thai', [BanAnController::class, 'updateTrangThai'])->name('ban-an.trang-thai');
Route::get('ban-an/trong', [BanAnController::class, 'getBanTrong'])->name('ban-an.trong');

// Quản lý món ăn
Route::resource('mon-an', MonAnController::class);

// Đặt bàn
Route::resource('dat-ban', DatBanController::class);

// Authentication cho nhân viên
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

