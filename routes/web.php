<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs/create', [JobController::class, 'store'])->middleware('auth');
Route::get('/dashboard', [JobController::class, 'userJobs']);
Route::delete('/dashboard/{id}', [JobController::class, 'destroyJob'])->middleware('auth');
Route::get('/editJob/{id}', [JobController::class, 'EditJob'])->middleware('auth');
Route::post('/editJob/{id}', [JobController::class, 'updateJob'])->middleware('auth');

Route::get('/editEmployer', [EmployerController::class, 'EditEmployer'])->middleware('auth');
Route::post('/editEmployer', [EmployerController::class, 'UpdateName'])->middleware('auth');
Route::get('/editPassword', [EmployerController::class, 'editPassword'])->middleware('auth');
Route::post('/editPassword', [EmployerController::class, 'updatePassword'])->middleware('auth');


Route::get('/search', SearchController::class); // here we add the controller path not with an action this will make a method to be invoked
Route::get('/tags/{tag:name}', TagController::class); // select all jobs that associated with the tag

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);

    Route::post('/passwordReset', [SessionController::class, 'passwordEmail']);

    Route::get('/passwordReset', [PasswordController::class, 'showResetRequestForm']);
    Route::post('/passwordReset', [PasswordController::class, 'sendResetLink']);
    Route::get('/password/reset/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/ChangePassword', [PasswordController::class, 'NewPassword']);
});


Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
