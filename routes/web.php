<?php

use App\Models\User;
use App\Models\Agenda;
use App\Models\Evaluasi;
use App\Models\Celebrate;
use App\Models\TemaPortal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Dcblogdev\MsGraph\Facades\MsGraph;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\KlienController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\CelebrateController;
use App\Http\Controllers\TemaPortalController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TemaDashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// ! EMAIL VERIFICATION
// Route::get('/email/verify', function () {
//     $tema = TemaPortal::get()->first();
//     $agendas = Agenda::all();
//     return view('auth.verify-email', [
//         'tema' => $tema,
//         'agendas' => $agendas
//     ]);
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/portal');
// })->middleware(['auth'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// ! END EMAIL VERIFICATION

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

    // Route::get('/agenda/{agenda}', [AgendaController::class, 'show']);
    // Route::get('/celebrate/{user}', [CelebrateController::class, 'showAll']);

    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/dashboard', [PortalController::class, 'dashboard'])->name('portal.dashboard');
        Route::resource('/dashboard/klien', KlienController::class);
        Route::resource('/dashboard/user', UserController::class);
        Route::resource('/dashboard/agenda', AgendaController::class);
        Route::resource('/dashboard/evaluasi', EvaluasiController::class);
        Route::resource('/dashboard/agenda', AgendaController::class);
        Route::resource('/dashboard/news', BeritaController::class);

        Route::get('/dashboard/celebrate', [CelebrateController::class, 'index'])->name('celebrate.index');
        Route::post('/dashboard/celebrate', [CelebrateController::class, 'store'])->name('celebrate.store');
        Route::get('/dashboard/celebrate/create/{user}', [CelebrateController::class, 'create'])->name('celebrate.create');
        Route::get('/dashboard/celebrate/{celebrate}', [CelebrateController::class, 'show'])->name('celebrate.show');
        Route::delete('/dashboard/celebrate/{celebrate}', [CelebrateController::class, 'destroy'])->name('celebrate.destroy');
        Route::put('/dashboard/celebrate/{celebrate}', [CelebrateController::class, 'update'])->name('celebrate.update');
        Route::get('/dashboard/celebrate/{celebrate}/edit', [CelebrateController::class, 'edit'])->name('celebrate.edit');

        Route::get('/dashboard/temaportal', [TemaPortalController::class, 'index'])->name('temaportal.index');
        Route::post('/dashboard/temaportal', [TemaPortalController::class, 'store'])->name('temaportal.store');
        Route::get('/dashboard/temadashboard', [TemaDashboardController::class, 'index'])->name('temadashboard.index');
        Route::post('/dashboard/temadashboard', [TemaDashboardController::class, 'store'])->name('temadashboard.store');
    });

    Route::post('/newsapi', [NewsController::class, 'storeapi'])->name('news.storeapi');
    Route::get('/news/{id}', [BeritaController::class, 'shownews']);

    Route::post('/import/user', [UserController::class, 'import'])->name('importUser');
    // Route::post('/import/agenda', [AgendaController::class, 'import'])->name('importAgenda');

    Route::get('/show/agenda/{id}', [AgendaController::class, 'showagenda'])->name('showagenda');
    Route::get('/show/celebrate/{id}', [CelebrateController::class, 'showcelebrate'])->name('showcelebrate');
    Route::get('/show/news/{id}', [BeritaController::class, 'shownews'])->name('shownews');
});

Route::get('/profile', [PortalController::class, 'profile'])->name('portal.profile')->middleware('auth');
Route::put('/update/profile/{user}', [PortalController::class, 'updateprofile'])->name('update.profile')->middleware('auth');
