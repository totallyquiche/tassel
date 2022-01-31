<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromptController;

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

Route::get('/', fn() => redirect(route('drafts')));

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/prompt/{id}', [PromptController::class, 'index'])
        ->whereNumber('id')
        ->name('prompt');
    Route::get('/prompt/random', [PromptController::class, 'random'])
        ->name('prompt.random');
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/drafts', fn() => view('drafts'))->name('drafts');
});
