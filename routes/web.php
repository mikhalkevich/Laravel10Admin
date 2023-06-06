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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('admin')->group(function () {
        Route::get('charts', [Controllers\UserController::class, 'getCharts']);
        Route::get('users', [Controllers\UserController::class, 'getUsers']);
        Route::resource('catalog', Controllers\CatalogController::class);
        Route::resource('product', Controllers\ProductController::class);
        Route::post('product/{product}', [Controllers\ProductController::class, 'addCatalog']);
        Route::post('product/{product}/add_picture', [Controllers\ProductController::class, 'addPicture']);
    });
});
Route::prefix('ajax')->group(function(){
    Route::post('catalog/onliner',[Controllers\CatalogController::class,'getOnliner']);
});

require __DIR__ . '/auth.php';
