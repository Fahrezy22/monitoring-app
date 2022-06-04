<?php

use App\Http\Controllers\Admin\DaerahController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.check');
Route::group([
        'middleware' => 'auth'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::group([
        'prefix' => '/Admin'
        ], function(){
          Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
          Route::group([
            'prefix' => '/Daerah'
          ], function(){
              Route::get('/',[DaerahController::class, 'index'])->name('daerah');
              Route::post('/',[DaerahController::class, 'store']);
              Route::get('/{id}/edit',[DaerahController::class, 'edit'])->name('daerah.edit');
          });
        });
});
