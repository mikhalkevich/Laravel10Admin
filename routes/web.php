<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', [Controllers\BaseController::class, 'getIndex']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('admin')->group(function () {
        Route::get('/', [ProfileController::class, 'edit']);
        Route::get('charts', [Controllers\UserController::class, 'getCharts']);
        Route::get('users', [Controllers\UserController::class, 'getUsers']);
        Route::resource('catalog', Controllers\CatalogController::class);
        Route::resource('product', Controllers\ProductController::class);
        Route::get('catalog_onliner', [Controllers\CatalogController::class, 'getCatalogOnliner']);
        Route::post('product/{product}', [Controllers\ProductController::class, 'addCatalog']);
        Route::post('product/{product}/add_picture', [Controllers\ProductController::class, 'addPicture']);
    });
});
Route::get('catalog/{url}', [Controllers\CatalogController::class, 'getUrl']);
Route::get('catalog/{catalog}/subcatalogs', [Controllers\CatalogController::class, 'subcatalogs']);

Route::get('catalog_data/{id}', [Controllers\CatalogController::class, 'getData']);
Route::get('catalog_book/{id}', [Controllers\BookController::class, 'getCatalogBook']);
Route::post('catalog_book/{id}/book_add', [Controllers\BookController::class, 'postBook']);
Route::get('book/{book}', [Controllers\BookController::class, 'getOne']);
Route::get('book/{book}/find_cover', [Controllers\BookController::class, 'findCover']);
Route::get('book/{book}/find_cover_original', [Controllers\BookController::class, 'findCoverOriginal']);
Route::get('book/{book}/get_book_cover', [Controllers\BookController::class, 'getBookCover']);
Route::get('catalog_catalog/{data_id}/{id}', [Controllers\CatalogController::class, 'getCatalogCatalog']);
Route::prefix('ajax')->group(function () {
    Route::post('catalog/onliner', [Controllers\CatalogController::class, 'getOnliner']);
});

require __DIR__ . '/auth.php';
