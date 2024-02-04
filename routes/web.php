<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;

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

Auth::routes(['register'=> false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    
    // Menu Routes
    Route::get('/menu', [MenuController::class, 'index']);
    Route::prefix('menu')->as('menu.')->group(function(){
        Route::post('/datatable-data', [MenuController::class, 'get_datatable_data'])->name('datatable.data');
        Route::post('/store-or-update', [MenuController::class, 'store_or_update_data'])->name('store.or.update');
        Route::post('/edit', [MenuController::class, 'edit'])->name('edit');
        Route::post('/delete', [MenuController::class, 'delete'])->name('delete');
        Route::post('/bulk-delete', [MenuController::class, 'bulk_delete'])->name('bulk.delete');
    });
    
});
