<?php

use App\Http\Controllers\BusinessData\BranchesController;
use App\Http\Controllers\BusinessData\BusinessController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return redirect(route('businesses.index'));
});

Route::resource('businesses', BusinessController::class)->except(['update', 'edit', 'destroy']);
Route::delete('businesses/{id}/destroy', [BusinessController::class, 'destroy'])->name('businesses.destroy');

Route::resource('businesses.branches', BranchesController::class)->shallow()->except(['index', 'update', 'edit']);
// Route::get('/businesses.index', [BusinessController::class, 'index'])->name('businesses.index');


require __DIR__ . '/auth.php';
