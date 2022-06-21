<?php

use App\Http\Controllers\Admin\DaerahController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserManagecontroller;
use App\Http\Controllers\Pj\DashboardController as PjDashboardController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.check');
Route::group([
        'middleware' => 'auth'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        // route for pj
        Route::group([
          'prefix' => '/Pj'
        ], function(){
            Route::get('dashboard', [PjDashboardController::class, 'index'])->name('dashboard2');
        });

        // route for admin
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
              Route::post('/Destroy/{id}',[DaerahController::class, 'destroy'])->name('daerah.destroy');
          });

          Route::group([
            'prefix' => '/Project'
          ], function(){
              Route::get('/',[ProjectController::class, 'index'])->name('project');
              Route::post('/',[ProjectController::class, 'store']);
              Route::get('/{id}/edit',[ProjectController::class, 'edit'])->name('project.edit');
              Route::post('/Destroy/{id}',[ProjectController::class, 'destroy'])->name('project.destroy');
          });

          Route::group([
            'prefix' => '/User-manage'
          ], function(){
              Route::get('/',[UserManagecontroller::class, 'index'])->name('user-manage');
              Route::post('/',[UserManagecontroller::class, 'store']);
              Route::get('/{id}/edit',[UserManagecontroller::class, 'edit'])->name('user-manage.edit');
              Route::post('/Destroy/{id}',[UserManagecontroller::class, 'destroy'])->name('user-manage.destroy');
          });
        });
});
