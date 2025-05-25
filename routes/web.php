<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

// Contrôleurs publics
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlayerPageController;
use App\Http\Controllers\TeamPageController;
use App\Http\Controllers\TournamentPageController;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\StreamPageController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 📝 Inscription
Route::get('/register', [RegisterController::class, 'show'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// 🌍 Localisation
Route::get('/locale/{locale}', function ($locale) {
    $languages = explode(',', env('LANGUAGES', 'en'));

    if (!in_array($locale, $languages)) {
        abort(400);
    }

    session()->put('locale', $locale);
    return response()->json(['message' => 'Langue changée avec succès'], 200);
})->name('lang');

// 🌐 Pages publiques
Route::get('/', [LandingPageController::class, 'index']);
Route::get('/posts', [PostController::class, 'posts']);
Route::get('/post/{slug}', [PostController::class, 'singlePost']);

Route::get('/players', [PlayerPageController::class, 'players']);
Route::get('/player/{slug}', [PlayerPageController::class, 'singlePlayer']);

Route::get('/teams', [TeamPageController::class, 'teams']);
Route::get('/team/{slug}', [TeamPageController::class, 'singleTeam']);

Route::get('/tournaments', [TournamentPageController::class, 'tournaments']);
Route::get('/tournament/{slug}', [TournamentPageController::class, 'singleTournament']);

Route::get('/page/{slug}', [CustomPageController::class, 'index']);

Route::get('/streams', [StreamPageController::class, 'streams']);
Route::get('/stream/{slug}', [StreamPageController::class, 'singleStream']);

// 🔧 Mises à jour
Route::get('/update/{version}', [UpdateController::class, 'update']);

// 🛠️ Admin Voyager CMS
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// 💳 Routes de paiement
Route::middleware(['auth'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'showForm'])->name('payment.form');
    Route::post('/payment/process', [PaymentController::class, 'initiatePayment'])->name('payment.process');
    Route::get('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
});

// 🔐 Dashboard (protégé + paiement requis)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check.payment',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
