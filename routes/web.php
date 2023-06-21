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
    return view('frontend.pages.dashboard');
});

Route::get('/matkul/preview', function () {
    return view('frontend.pages.matkul-preview');
});

Route::get('/matkul/matkul-saya', function () {
    return view('frontend.pages.mahasiswa.matkul-mahasiswa');
});

Route::get('/matkul/pertemuan', function () {
    return view('frontend.pages.mahasiswa.pertemuan.mahasiswa-pertemuan');
});

Route::get('/matkul/pertemuan/belajar', function () {
    return view('frontend.pages.mahasiswa.belajar.mahasiswa-belajar');
});

Route::get('/dosen/matkul', function () {
    return view('frontend.pages.dosen.matkul-dosen');
});

Route::get('/dosen/edit-matkul', function () {
    return view('frontend.pages.dosen.matkul.edit-matkul');
});

Route::get('/dosen/edit-pertemuan', function () {
    return view('frontend.pages.dosen.pertemuan.edit-pertemuan');
});

Route::get('/dosen/tambah-matkul', function () {
    return view('frontend.pages.dosen.matkul.tambah-matkul');
});

Route::get('/dosen/pertemuan', function () {
    return view('frontend.pages.dosen.pertemuan.view-pertemuan');
});

Route::get('/dosen/tambah-pertemuan', function () {
    return view('frontend.pages.dosen.pertemuan.tambah-pertemuan');
});
