<?php

use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\BerandaController;
use App\Http\Controllers\Front\CekoutController;
use App\Http\Controllers\Front\DetailProdukController;
use App\Http\Controllers\Front\KeranjanController;
use App\Http\Controllers\Front\SiswaProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group( function() {
    Route::get('/login', 'index')->name('siswa.login');
    Route::post('/login', 'login')->name('siswa.login.post');
    Route::post('/logout', 'logout')->name('siswa.logout');
});


Route::middleware('auth.siswa')->name('siswa.')->group( function() {
    //beranda
    Route::get('/', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/kategori/{id}', [BerandaController::class, 'produkKategori'])->name('produk.kategori');
    Route::get('/kantin/{id}', [BerandaController::class, 'kantin'])->name('produk.kantin');

    //keranjang
    Route::controller(KeranjanController::class)->group( function() {
        Route::get('/add-to-cart', 'addToCart')->name('addToCart');
        Route::get('/cart', 'cart')->name('cart');
    });

    //detail produk
    Route::controller(DetailProdukController::class)->group( function() {
        Route::get('/detail/{id}', 'index')->name('detail');
    });

    //cekout
    Route::controller(CekoutController::class)->group( function() {
        Route::get('/cekout-produk/{id}', 'produk')->name('cekout.produk');
    });

    //profile
    Route::controller(SiswaProfileController::class)->group( function() {
        Route::get('/profile', 'edit')->name('profile');
        Route::put('/profile/{id}', 'update')->name('profile.post');
    });
});



