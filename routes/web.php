<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TugasController;
use App\Http\Middleware\EnrolledCheck;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



// Public route
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/test', function () {
    return view('frontend.testpage');
});

// Routes accessible by guest users only
Route::middleware('guest')->group(function () {
    Route::resource('guest', GuestController::class);
});

// Laravel authentication routes
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/calendar', function () {
    return view('frontend.pages.calendar');
});

Route::get('/tugas', function () {
    return view('frontend/pages/tugas-page');
});





// Routes accessible by authenticated users only
Route::middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);

    Route::get('/download/{filename}', [DownloadController::class, 'download'])->name('download');

    Route::resource('matkul', MatkulController::class);
    Route::get('matkul/{id}/pertemuan', [MatkulController::class, 'pertemuanPreview'])->name('matkul.pertemuanPreview');

    Route::resource('pertemuan', PertemuanController::class);
    Route::get('pertemuan/{id}/list', [PertemuanController::class, 'indexPertemuan'])->name('pertemuan.indexPertemuan');
    Route::get('pertemuan/{id_matkul}/create', [PertemuanController::class, 'create'])->name('pertemuan.create');



    Route::resource('tugas', TugasController::class);
    Route::resource('submission', SubmissionController::class);
    Route::get('submissions/{id}', [SubmissionController::class, 'indexAll'])->name('submission.indexAll');
    Route::get('export/{id}', [SubmissionController::class, 'nilaiExcel'])->name('submission.nilaiExcel');
    Route::get('list/{id}/nilai', [NilaiController::class, 'show'])->name('nilai.show');
    Route::post('store/{id}/nilai', [NilaiController::class, 'store'])->name('nilai.store');
    // Route::get('tugas/{tuga}/list', [SubmissionController::class, 'indexAll'])->name('index-all');
    Route::get('/export-nilai/{id}', [ExportsController::class, 'export'])->name('export.nilai');

    Route::get('user/profile/edit', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::get('user/{user}/editPassword', [ProfileController::class, 'editPassword'])->name('user.editPassword');
    Route::put('user/{user}/updatePassword', [ProfileController::class, 'updatePassword'])->name('user.updatePassword');

    Route::get('materi/{id}/youtube', [MateriController::class, 'createVideo'])->name('materi.createVideo');
    Route::post('materi/{id}/store-video', [MateriController::class, 'storeVideo'])->name('materi.storeVideo');
    Route::delete('materi/{id}/delete-video', [MateriController::class, 'destroyYoutube'])->name('materi.destroyYoutube');

    Route::get('materi/{id}/file', [MateriController::class, 'createFile'])->name('materi.createFile');
    Route::post('materi/{id}/store-file', [MateriController::class, 'storeFile'])->name('materi.storeFile');
    Route::delete('materi/{id}/delete-file', [MateriController::class, 'destroyFile'])->name('materi.destroyfile');
    Route::delete('materi/{id}/delete-image', [MateriController::class, 'destroyImage'])->name('materi.destroyImage');

    Route::get('materi/{pertemuanId}/tugas/create', [MateriController::class, 'createTugas'])->name('materi.createTugas');
    Route::post('materi/{id}/store-tugas', [MateriController::class, 'storeTugas'])->name('materi.storeTugas');
    Route::delete('materi/{id}/delete-tugas', [MateriController::class, 'destroyTugas'])->name('materi.destroytugas');

    Route::resource('forum', ForumController::class);
    Route::resource('topic', TopicController::class);
    Route::resource('comment', CommentController::class);


    Route::get('enroll', [EnrollController::class, 'index'])->name('enroll.index');
    Route::post('enroll', [EnrollController::class, 'store'])->name('enroll.store');
    Route::get('enroll/{id}/matkul-preview', [EnrollController::class, 'previewMatkul'])->name('enroll.previewMatkul');

    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('dosen', DosenController::class);

    Route::get('user/preferences', function () {
        return view('frontend.pages.preferences');
    })->name('user.preferences');



    // Routes for admins
    Route::middleware(['admin'])->group(function () {

        Route::resource('admin', AdminController::class);
        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class)->except(['create']);
        Route::get('/admin/create/mahasiswa', [UserController::class, 'indexMahasiswa'])->name('user.tambahMahasiswa');
        Route::get('/admin/create/dosen', [UserController::class, 'indexDosen'])->name('user.tambahDosen');
        Route::get('/admin/create/admin', [UserController::class, 'indexAdmin'])->name('user.tambahAdmin');
        // Add more admin-specific routes here

    });
});
