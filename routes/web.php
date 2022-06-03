<?php

use App\Http\Controllers\JobClassController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/global', function () {
    return view('layouts.global');
});

Auth::routes();

Route::any('/register', function () {
    return redirect('/login');
})->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('backend.home');

//Route User
Route::resource('users', UserController::class);

//Route Job Class
Route::get('jobclass/trash', [JobClassController::class, 'trash'])->name('jobclass.trash');
Route::get('/jobclass/{id}/restore', [JobClassController::class, 'restore'])->name('jobclass.restore');
Route::delete('/jobclass/{jobclass}/delete-permanent', [JobClassController::class, 'deletePermanent'])->name('jobclass.delete-permanent');
Route::get('/ajax/jobclass/search', [JobClassController::class, 'ajaxSearch']);
Route::resource('jobclass', JobClassController::class);

//Route Skill
Route::resource('skill', SkillController::class);
