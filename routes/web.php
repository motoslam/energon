<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TaskController;
use App\Models\Company;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', DashboardController::class)
        ->middleware(['auth'])->name('dashboard');

    Route::get('/companies/check-available', [CompanyController::class, 'check'])
        ->middleware(['auth'])->name('companies.check');

    Route::resource('companies', CompanyController::class)
        ->middleware(['auth']);

    Route::get('companies/{company}/tasks', [CompanyController::class, 'tasks'])
        ->middleware(['auth'])->name('companies.tasks');

    Route::resource('tasks', TaskController::class)
        ->middleware(['auth']);

    Route::get('stats', function (){
        return view('stats.index');
    })
        ->name('stats.index')
        ->middleware('auth');

});

require __DIR__.'/json.php';

require __DIR__.'/auth.php';
