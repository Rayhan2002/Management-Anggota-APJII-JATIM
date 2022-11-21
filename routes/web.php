<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EventController, ParticipantController, CertificateController, AnggotaController
};

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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home',                             [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('certificates-user',

           [CertificateController::class,'indexUser'])->name('certificates-user');

    Route::middleware(['admin'])->group(function () {
        Route::resource('events',                   EventController::class);
        Route::resource('participants',             ParticipantController::class);
        Route::resource('certificates',             CertificateController::class);
        Route::get('certificates-generate/{id?}',   [CertificateController::class,'generate'])->name('certificates.generate');
        Route::post('import-participants',          [EventController::class,'import'])->name('import-participants');
        Route::resource('anggotas',                 AnggotaController::class);
        Route::get('list',                          [AnggotaController::class, 'list'])->name('list');
        Route::post('/getkabupaten',                [AnggotaController::class, 'getkabupaten'])->name('getkabupaten');
        Route::post('/getkecamatan',                [AnggotaController::class, 'getkecamatan'])->name('getkecamatan');
        Route::post('/getdesa',                     [AnggotaController::class, 'getdesa'])->name('getdesa');
        Route::get('/anggota/export',               [AnggotaController::class, 'exportData'])->name('exportData');
    });

    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    });
});
