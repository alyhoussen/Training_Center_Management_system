<?php

use App\Http\Controllers\BadgeController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\formationSessionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Models\Formation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/register', function () {
    return view('auth.login');
})->name('register');



Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/get', [DashboardController::class, 'get'])->name('get');
    Route::get('/{item}/search', [DashboardController::class, 'search'])->name('dashboard.search');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('teachers')->middleware('auth')->name('teachers.')->group(function () {
    Route::get('/', [TeachersController::class,'index'])->name('index');
    Route::post('/add', [TeachersController::class,'store'])->name('store');
    Route::get('/get', [TeachersController::class,'get'])->name('get');
    Route::post('/{id}/update', [TeachersController::class, 'update'])->name('update');
    Route::get('/{id}/delete', [TeachersController::class, 'destroy'])->name('destroy');
    Route::get('/{value}/search', [TeachersController::class, 'search'])->name('search');
});

Route::prefix('students')->middleware('auth')->name('students.')->group(function () {
    Route::get('/', [StudentsController::class, 'index'])->name('index');
    Route::get('/list', [StudentsController::class, 'list'])->name('list');
    Route::post('/add', [StudentsController::class, 'store'])->name('store');
    Route::get('/get', [StudentsController::class, 'get'])->name('get');
    Route::post('/{id}/update', [StudentsController::class, 'update'])->name('update');
    Route::get('/{id}/delete', [StudentsController::class, 'destroy'])->name('destroy');
    Route::get('/{value}/search', [StudentsController::class, 'search'])->name('search');
});

Route::prefix('payement')->middleware('auth')->name('payement.')->group(function () {
    Route::get('/', [PayementController::class,'index'])->name('index');
    Route::get('/get', [PayementController::class,'get'])->name('get');
    Route::get('/store', [PayementController::class,'store'])->name('store');
    Route::get('/{name}/search', [PayementController::class,'search'])->name('search');
    Route::get('/{value}/filter', [PayementController::class,'filter'])->name('filter');
    Route::get('/{id}/delete', [PayementController::class,'destroy'])->name('destroy');
    Route::get('/{id}-{pay}/update', [PayementController::class,'update'])->name('update');
});




#Not used routes yet

Route::prefix('programs')->middleware('auth')->name('programs.')->group(function () {
    Route::get('/', [ProgramsController::class,'index'])->name('index');
    Route::get('/store', [ProgramsController::class,'store'])->name('store');
    Route::get('/{id}/search', [ProgramsController::class,'search'])->name('search');
    Route::get('/edit', [ProgramsController::class,'update'])->name('update');
    Route::get('/{id}/delete', [ProgramsController::class,'destroy'])->name('destroy');
    Route::get('/{start}/{end}/{centre}/edt', [ProgramsController::class,'getEdt'])->name('edt');
});

Route::prefix('badge')->middleware('auth')->name('badge.')->group(function () {
    Route::get('/', [BadgeController::class,'index'])->name('index');
    Route::get('/store', [BadgeController::class,'store'])->name('store');
});


Route::prefix('formationSession')->middleware('auth')->name('formationSession.')->group(function () {
    Route::get('/', [formationSessionController::class,'index'])->name('index');
    Route::post('/store', [formationSessionController::class,'store'])->name('store');
    Route::get('/get', [formationSessionController::class,'get'])->name('get');
    Route::post('/{id}/update', [formationSessionController::class,'update'])->name('update');
    Route::get('/{id}/delete', [formationSessionController::class,'destroy'])->name('destroy');
});

Route::prefix('budget')->middleware('auth')->name('budget.')->group(function () {
    Route::get('/', [BudgetController::class,'index'])->name('index');
    Route::post('/store', [BudgetController::class,'store'])->name('store');
    Route::get('/{id}-{value}/verify', [BudgetController::class,'verify'])->name('verify');
    Route::get('/get', [BudgetController::class,'get'])->name('get');
});

Route::prefix('certifications')->middleware('auth')->name('certifications.')->group(function () {
    Route::get('/', [PayementController::class,'index'])->name('index');
    Route::get('/store', [PayementController::class,'store'])->name('store');
});
Route::prefix('notifications')->middleware('auth')->name('notifications.')->group(function () {
    Route::get('/', [NotificationController::class,'index'])->name('index');
    Route::get('/store', [NotificationController::class,'store'])->name('store');
    Route::get('/getNumber', [NotificationController::class,'getNumber'])->name('getNumber');
    Route::get('/get', [NotificationController::class,'get'])->name('get');
    Route::get('/{id}/delete', [NotificationController::class,'destroy'])->name('destroy');

});
Route::prefix('stats')->middleware('auth')->name('stats.')->group(function () {
    Route::get('/', [PayementController::class,'index'])->name('index');
    Route::get('/store', [PayementController::class,'store'])->name('store');
});

Route::prefix('formation')->middleware('auth')->name('formation.')->group(function () {
    Route::get('/', [FormationController::class,'index'])->name('index');
    Route::post('/store', [FormationController::class,'store'])->name('store');
    Route::get('/get', [FormationController::class,'get'])->name('get');
    Route::post('/{id}/update', [FormationController::class,'update'])->name('update');
    Route::get('/{id}/delete', [FormationController::class,'destroy'])->name('destroy');
});

Route::prefix('messages')->middleware('auth')->name('messages.')->group(function () {
    Route::get('/', [MessageController::class,'index'])->name('index');
    Route::post('/store', [MessageController::class,'store'])->name('store');
    Route::get('/get', [MessageController::class,'get'])->name('get');
    Route::get('/{id}', [MessageController::class,'mp'])->name('mp');
});

Route::prefix('email')->middleware('auth')->name('email.')->group(function () {
    Route::get('/', [MessageController::class,'index'])->name('index');
    Route::get('/store', [MessageController::class,'store'])->name('store');
    Route::get('/get', [MessageController::class,'get'])->name('get');
});








require __DIR__.'/auth.php';
