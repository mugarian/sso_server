<?php

use App\Models\Celebrate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Dcblogdev\MsGraph\Facades\MsGraph;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\CelebrateController;
use App\Http\Controllers\TemaPortalController;
use App\Http\Controllers\TemaDashboardController;

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

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/admin', function () {
    return redirect('/login')->with('admin', 'Login Untuk Admin');
});

Route::get('/faq', [PortalController::class, 'faq'])->name('faq');


Route::get('connect', [PortalController::class, 'connect'])->name('connect');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'profil'])->group(function () {
    Route::get('check', function () {
        return MsGraph::get('me/photo');
    });
    Route::get('/app', [PortalController::class, 'app'])->name('app');
    Route::get('/ms/logout', [PortalController::class, 'logout'])->name('mslogout');

    Route::get('/portal', [PortalController::class, 'index'])->name('portal.index');
    Route::get('/dashboard', [PortalController::class, 'dashboard'])->name('portal.dashboard');

    Route::get('/agenda/{agenda}', [AgendaController::class, 'show']);
    Route::get('/celebrate/{user}', [CelebrateController::class, 'showAll']);

    Route::resource('/dashboard/klien', KlienController::class);
    Route::resource('/dashboard/user', UserController::class);
    Route::resource('/dashboard/agenda', AgendaController::class);

    Route::get('/dashboard/celebrate', [CelebrateController::class, 'index'])->name('celebrate.index');
    Route::post('/dashboard/celebrate', [CelebrateController::class, 'store'])->name('celebrate.store');
    Route::get('/dashboard/celebrate/create/{user}', [CelebrateController::class, 'create'])->name('celebrate.create');
    Route::get('/dashboard/celebrate/{celebrate}', [CelebrateController::class, 'show'])->name('celebrate.show');
    Route::delete('/dashboard/celebrate/{celebrate}', [CelebrateController::class, 'destroy'])->name('celebrate.destroy');
    Route::put('/dashboard/celebrate/{celebrate}', [CelebrateController::class, 'update'])->name('celebrate.update');
    Route::get('/dashboard/celebrate/{celebrate}/edit', [CelebrateController::class, 'edit'])->name('celebrate.edit');

    Route::resource('/dashboard/agenda', AgendaController::class);

    Route::resource('/dashboard/news', BeritaController::class);
    Route::post('/newsapi', [NewsController::class, 'storeapi'])->name('news.storeapi');
    Route::get('/news/{id}', [BeritaController::class, 'shownews']);

    Route::get('/dashboard/temaportal', [TemaPortalController::class, 'index'])->name('temaportal.index');
    Route::post('/dashboard/temaportal', [TemaPortalController::class, 'store'])->name('temaportal.store');

    Route::get('/dashboard/temadashboard', [TemaDashboardController::class, 'index'])->name('temadashboard.index');
    Route::post('/dashboard/temadashboard', [TemaDashboardController::class, 'store'])->name('temadashboard.store');
});

Route::get('/profile', [PortalController::class, 'profile'])->name('portal.profile')->middleware('auth');
Route::put('/update/profile/{user}', [PortalController::class, 'updateprofile'])->name('update.profile')->middleware('auth');
