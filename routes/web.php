<?php

use App\Http\Controllers\MadingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MadingController::class, 'index'])->name('home');

Route::get('/tag', [TagController::class, 'index'])->name('tag');
Route::get('/tag/{tag:slug}', [TagController::class, 'show'])->name('tag.show');

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.id');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::post('/mading/store', [MadingController::class, 'store'])->name('mading.store')->middleware('auth');
Route::post('/mading/update/{id}', [MadingController::class, 'update'])->name('mading.update')->middleware('auth');
Route::post('/mading/delete/{id}', [MadingController::class, 'delete'])->name('mading.delete')->middleware('auth');


require __DIR__ . '/auth.php';
