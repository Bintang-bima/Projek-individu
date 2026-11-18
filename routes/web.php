<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\{
    FilmController,
    KritikController,
    AuthController,
    ProfileController,
    Admin\DashboardController,
    Admin\FilmController as AdminFilmController,
    Admin\GenreController as AdminGenreController,
    Admin\CastController as AdminCastController,
    Admin\PeranController as AdminPeranController,
    Admin\KritikController as AdminKritikController,
    Admin\UserController as AdminUserController,
};

// ---------- Public site ----------
Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/search', [FilmController::class, 'search'])->name('movies.search');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');

Route::middleware('auth')->post('/movies/{film}/kritik', [KritikController::class, 'store'])->name('kritik.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ---------- Authentication ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    // Pendaftaran akun hanya lewat modal (form "Create an account"); tidak ada halaman terpisah.
    Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.attempt');
    // Link lama ke /register tetap ramah: arahkan ke halaman login.
    Route::get('/register', fn () => redirect()->route('login'))->name('register');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ---------- Admin panel ----------
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('films', AdminFilmController::class)->except('show');
        Route::resource('genres', AdminGenreController::class)->except('show');
        Route::resource('casts', AdminCastController::class)->except('show');
        Route::resource('perans', AdminPeranController::class)->except('show');
        Route::resource('kritiks', AdminKritikController::class)->except('store', 'show', 'create');
        Route::resource('users', AdminUserController::class)->except('show');
    });
