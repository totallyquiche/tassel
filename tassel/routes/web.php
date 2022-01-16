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

Route::get('/', fn() => view('home'));

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});
