<?php

use App\Http\Controllers\Json\CompanyStatusController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('json')->name('json.')->group(function () {

    Route::get('/classifieds/company/statuses', [CompanyStatusController::class, 'index'])
        ->name('classifieds.company.statuses');

});
