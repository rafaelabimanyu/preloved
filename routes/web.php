<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DropController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LookbookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// ──────────────────────────────────────────────────────────────────────────────
// AUTH
// ──────────────────────────────────────────────────────────────────────────────
Route::get('/login',   [Admin\AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [Admin\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [Admin\AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ──────────────────────────────────────────────────────────────────────────────
// LANGUAGE SWITCH
//   GET /language/{lang}
//   Saves locale to session, redirects back to previous page.
//   No URL rewriting — locale lives in session only.
// ──────────────────────────────────────────────────────────────────────────────
Route::get('/language/{lang}', [LanguageController::class, 'switch'])
    ->where('lang', 'en|id')
    ->name('language.switch');

// ──────────────────────────────────────────────────────────────────────────────
// PUBLIC — Clean URLs (no locale prefix)
//   SetLocale middleware (global) reads locale from session, then browser,
//   then falls back to 'en'. No URL segment needed.
// ──────────────────────────────────────────────────────────────────────────────

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Drops
Route::prefix('drops')->name('drops.')->group(function () {
    Route::get('/',        [DropController::class, 'index'])->name('index');
    Route::get('/{drop}',  [DropController::class, 'show'])->name('show');
});

// Catalog
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');

// Item detail
Route::get('/item/{item}', [ItemController::class, 'show'])->name('items.show');

// Lookbook
Route::prefix('lookbook')->name('lookbook.')->group(function () {
    Route::get('/',            [LookbookController::class, 'index'])->name('index');
    Route::get('/{lookbook}',  [LookbookController::class, 'show'])->name('show');
});

// Static pages
Route::get('/about',    [PageController::class, 'about'])->name('about');
Route::get('/care',     [PageController::class, 'care'])->name('care');
Route::get('/contact',  [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'sendInquiry'])->name('contact.send');

// ──────────────────────────────────────────────────────────────────────────────
// ADMIN — Curation Studio (auth + is_admin protected)
// ──────────────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('drops',     Admin\DropController::class);
        Route::resource('items',     Admin\ItemController::class);
        Route::resource('lookbooks', Admin\LookbookController::class);

        Route::get('inquiries',                [Admin\InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('inquiries/{inquiry}',      [Admin\InquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('inquiries/{inquiry}/read', [Admin\InquiryController::class, 'markRead'])->name('inquiries.read');

        Route::get('settings',  [Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [Admin\SettingController::class, 'update'])->name('settings.update');

        // Image upload helper (AJAX — item / lookbook forms)
        Route::post('upload', [Admin\UploadController::class, 'store'])->name('upload');
    });
