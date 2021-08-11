<?php

use App\Http\Controllers\Json\CompanyStatusController;
use App\Http\Controllers\Json\CityController;
use App\Http\Controllers\EventController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('json')->name('json.')->group(function () {

    Route::get('/classifieds/company/statuses', [CompanyStatusController::class, 'index'])
        ->name('classifieds.company.statuses');

    Route::get('/classifieds/cities/find', [CityController::class, 'find'])
        ->name('classifieds.cities.find');

});
