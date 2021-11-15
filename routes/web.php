<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TaskController as PlannerController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\SettingController;
use App\Models\Company;
use App\Models\City;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Event;

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

    //$utcOffset = 'UTC+3';

    //$timezone = new DateTimeZone($utcOffset);

    //ddd($timezone);

    //$timezone = timezone_name_from_abbr(null, $utcOffset * 3600, TRUE);
    //$dateTime = new DateTime();
    //$dateTime->setTimeZone(new DateTimeZone($timezone));
    //$timezone = $dateTime->format('T');

    //$user = auth()->user();
//
    //$user->role_id = 1;
    //$user->save();

    //return $user->role->name;
    $date = '2021-11-15 15:42';
    $datetime = Carbon::createFromFormat('Y-m-d H:i', $date)->toDateTimeString();
    return $datetime;
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
        ->name('companies.bundle');

    Route::post('companies/{company}/bundle', [CompanyController::class, 'binding'])
        ->name('companies.binding');

    Route::resource('contacts', ContactController::class);

    Route::post('/events/add', [EventController::class, 'store'])
        ->name('events.add');

    Route::post('tasks/{task}/go', [TaskController::class, 'go'])->name('tasks.go');
    Route::resource('tasks', TaskController::class);

    Route::get('stats', function () {
        return view('stats.index');
    })->name('stats.index');

    Route::get('alerts', [AlertController::class, 'index'])->name('alerts.index');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'store'])->name('settings.store');

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::get('/users/trash', [UserController::class, 'trash'])->name('users.trash');
        Route::post('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
        Route::resource('users', UserController::class);

        Route::resource('tasks', PlannerController::class);

    });

});

require __DIR__ . '/json.php';

require __DIR__ . '/auth.php';
