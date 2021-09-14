<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EventController;
use App\Models\Company;
use App\Models\City;
use App\Models\Task;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alpine', function () {
    //$company = Company::find(1)->first();

    /*$task = Task::find(1)->first();
    $task->deadline_at = Carbon::createFromFormat('d.m.Y', '11.04.2020');
    $task->save();*/

    //$event->attachable()->associate($contact);
    //$event->save();

    //$string = 'ООО ООО "ГЕНЕРАЛЬНЫЙ ПРОЕКТ"';

    //$string = mb_substr($string, (mb_stripos($string, '"')+1), -1);

    $utcOffset = 'UTC+3';

    $timezone = new DateTimeZone($utcOffset);

    ddd($timezone);

    //$timezone = timezone_name_from_abbr(null, $utcOffset * 3600, TRUE);
    //$dateTime = new DateTime();
    //$dateTime->setTimeZone(new DateTimeZone($timezone));
    //$timezone = $dateTime->format('T');

    return '';
});

Route::middleware(['auth'])->group(function () {

    Route::get('/companies/check-available', [CompanyController::class, 'check'])
        ->middleware(['auth'])->name('companies.check');

    Route::resource('companies', CompanyController::class)
        ->middleware(['auth']);

    Route::get('companies/{company}/contacts', [CompanyController::class, 'contacts'])
        ->middleware(['auth'])->name('companies.contacts');

    Route::get('companies/{company}/tasks', [CompanyController::class, 'tasks'])
        ->middleware(['auth'])->name('companies.tasks');

    Route::get('companies/{company}/bundle', [CompanyController::class, 'bundle'])
        ->middleware(['auth'])->name('companies.bundle');

    Route::post('companies/{company}/bundle', [CompanyController::class, 'binding'])
        ->middleware(['auth'])->name('companies.binding');

    Route::resource('contacts', ContactController::class)
        ->middleware(['auth']);

    Route::post('/events/add', [EventController::class, 'store'])
        ->name('events.add');

    Route::resource('tasks', TaskController::class)
        ->middleware(['auth']);

    Route::get('stats', function (){
        return view('stats.index');
    })->name('stats.index');

});

require __DIR__.'/json.php';

require __DIR__.'/auth.php';
