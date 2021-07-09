<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\FileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => 'auth', 'verified'], function() {
    # Attributes
    Route::get('attributes', [AttributeController::class, 'index'])->name('attributes');
    Route::get('attributes/create', [AttributeController::class, 'create'])->name('attributes.create');
    Route::post('attributes/create', [AttributeController::class, 'store']);
    Route::get('attributes/{id}', [AttributeController::class, 'edit'])->name('attributes.edit');
    Route::put('attributes/{id}', [AttributeController::class, 'update']);
    Route::delete('attributes/{id}', [AttributeController::class, 'destroy'])->name('attributes.delete');

    # Files
    Route::get('files', [FileController::class, 'index'])->name('files');
    Route::get('files/create', [FileController::class, 'create'])->name('files.create');
    Route::post('files/create', [FileController::class, 'store']);
    Route::get('files/{id}', [FileController::class, 'edit'])->name('files.edit');
    Route::put('files/{id}', [FileController::class, 'update']);
    Route::delete('files/{id}', [FileController::class, 'destroy'])->name('files.delete');
});


require __DIR__.'/auth.php';
