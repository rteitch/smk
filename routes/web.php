<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\JobClassController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\OrderQController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Artikel;

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

Route::get('change-password', [ChangePasswordController::class, 'index']);
Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('auth.change-password');

Auth::routes();

Route::any('/register', function () {
    return redirect('/login');
})->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('backend.home');

//Route User
// Route::get('/users/artikel/{user}', function($id){
//     $user = User::with('artikel')->find($id);
//     return response()->json($user, 200);
// });
Route::resource('users', UserController::class);
//Route Job Class
Route::get('/jobclass/trash', [JobClassController::class, 'trash'])->name('jobclass.trash');
Route::get('/jobclass/{id}/restore', [JobClassController::class, 'restore'])->name('jobclass.restore');
Route::delete('/jobclass/{jobclass}/delete-permanent', [JobClassController::class, 'deletePermanent'])->name('jobclass.delete-permanent');
Route::get('/ajax/jobclass/search', [JobClassController::class, 'ajaxSearch']);
Route::resource('jobclass', JobClassController::class);

//Route Skill
Route::get('/skill/trash', [SkillController::class, 'trash'])->name('skill.trash');
Route::get('/skill/{id}/restore', [SkillController::class, 'restore'])->name('skill.restore');
Route::delete('/skill/{skill}/delete-permanent', [SkillController::class, 'deletePermanent'])->name('skill.delete-permanent');
Route::get('/ajax/skill/search', [SkillController::class, 'ajaxSearch']);
Route::resource('skill', SkillController::class);

//Route Quest
Route::get('/quest/trash', [QuestController::class, 'trash'])->name('quest.trash');
Route::post('/quest/{quest}/restore', [QuestController::class, 'restore'])->name('quest.restore');
Route::delete('/quest/{quest}/delete-permanent', [QuestController::class, 'deletePermanent'])->name('quest.delete-permanent');
Route::resource('quest', QuestController::class);

//Route OrderQ
Route::resource('orderq', OrderQController::class);

//Route News
// Route::get('/news/{news}', function($id){
//     $news = News::with('users')->find($id);
//     return response()->json($news, 200);
// });

// Route::get('/artikel/json/{user}', function($id){
//     $user = Artikel::with('user')->find($id);
//     return response()->json($user, 200);
// });

Route::get('/artikel/trash', [ArtikelController::class, 'trash'])->name('artikel.trash');
Route::post('/artikel/{artikel}/restore', [ArtikelController::class, 'restore'])->name('artikel.restore');
Route::delete('/artikel/{artikel}/delete-permanent', [ArtikelController::class, 'deletePermanent'])->name('artikel.delete-permanent');
// Route::post('news/upload', [ArtikelController::class, 'upload'])->name('news.upload');
Route::resource('artikel', ArtikelController::class);
