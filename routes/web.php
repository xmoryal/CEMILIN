<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\KantinController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Kantin\DashboardController;
use App\Http\Controllers\Kantin\ProdukController;
use App\Http\Controllers\Kantin\ProfileController;
use Illuminate\Support\Facades\Route;

//proses login dan logout
Route::controller(AuthController::class)->group( function() {
    Route::get('admin-login', 'index')->name('admin.login');
    Route::post('admin-login', 'login')->name('admin.login.post');

    //logout 
    Route::post('admin-logout', 'logout')->name('admin.logout');
});

//halaman kantin
Route::middleware('auth.kantin')->prefix('penjual')->name('penjual.')->group( function() {
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //kelola produk
    Route::controller(ProdukController::class)->group( function() {
        Route::get('/produk', 'index')->name('produk.index');
        Route::get('/produk/tambah', 'create')->name('produk.add');
        Route::post('/produk/tambah', 'store')->name('produk.add.post');
        Route::get('/produk/{id}/edit', 'edit')->name('produk.edit');
        Route::put('/produk/{id}', 'update')->name('produk.edit.post');
        Route::delete('/produk/{id}', 'destroy')->name('produk.delete');
    });

    //profile
    Route::controller(ProfileController::class)->group( function() {
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::put('/profile/{id}', 'update')->name('profile.edit.post');
    });
});
    

//halaman admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group( function () {
    //dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('beranda');

    //siswa
    Route::controller(SiswaController::class)->group( function() {
        Route::get('/siswa', 'index')->name('siswa.index');
        Route::get('/siswa/tambah', 'create')->name('siswa.add');
        Route::post('/siswa/tambah', 'store')->name('siswa.add.post');
        Route::get('/siswa/{id}/edit', 'edit')->name('siswa.edit');
        Route::put('/siswa/{id}', 'update')->name('siswa.edit.post');
        Route::delete('/siswa/{id}', 'destroy')->name('siswa.delete');
    });

    //kantin
    Route::controller(KantinController::class)->group( function() {
        Route::get('/kantin', 'index')->name('kantin.index');
        Route::get('/kantin/tambah', 'create')->name('kantin.add');
        Route::post('/kantin/tambah', 'store')->name('kantin.add.post');
        Route::get('/kantin/{id}/edit', 'edit')->name('kantin.edit');
        Route::put('/kantin/{id}', 'update')->name('kantin.edit.post');
        Route::delete('/kantin/{id}', 'destroy')->name('kantin.delete');
    });

    //kategori produk
    Route::controller(KategoriController::class)->group( function() {
        Route::get('/kategori', 'list')->name('kategori.list');
        Route::get('/kategori/tambah', 'add')->name('kategori.add');
        Route::post('/kategori/tambah', 'addPost')->name('kategori.add.post');
        Route::get('/kategori/{id}/edit', 'edit')->name('kategori.edit');
        Route::put('/kategori/{id}', 'editPost')->name('kategori.edit.post');
        Route::delete('/kategori/{id}', 'delete')->name('kategori.delete');
    });

    //produk
    Route::controller(AdminProdukController::class)->group( function() {
        Route::get('/produk', 'index')->name('produk.index');
    });
}); 

require __DIR__.'/front.php';
