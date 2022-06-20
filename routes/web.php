<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\JobClassController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\JobDasarController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\OrderQController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\OrderRController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Artikel;
use App\Models\OrderQ;
use Illuminate\Support\Facades\Auth;

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
    if(Auth::check()){
        return view('backend.home');
    } else{
        return view('auth.login');
    }
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

Route::post('/jobclass/published/{id}/batal', [UserController::class, 'hapusUserJobClass'])->name('user.hapusUserJobClass');
Route::post('/quest/published/{id}/tambah', [UserController::class, 'tambahOrderQuest'])->name('user.tambahOrderQuest');
Route::post('/jobclass/published/{id}/tambah', [UserController::class, 'tambahJobClass'])->name('user.tambahJobClass');
Route::post('/skill/published/{id}/tambah', [UserController::class, 'tambahSkill'])->name('user.tambahSkill');
Route::resource('users', UserController::class);

//Route Job Class

Route::get('/jobclass/skill/{skill:slug}', [SkillController::class, 'skillJobClass'])->name('jobclass.skillJobClass');

Route::get('/jobclass/published', [JobClassController::class, 'published'])->name('jobclass.published');
Route::get('/jobclass/published/{artikel:slug}', [JobClassController::class, 'lihatJobClass'])->name('jobclass.lihatJobClass');
Route::get('/jobclass/trash', [JobClassController::class, 'trash'])->name('jobclass.trash');
Route::get('/jobclass/{id}/restore', [JobClassController::class, 'restore'])->name('jobclass.restore');
Route::delete('/jobclass/{jobclass}/delete-permanent', [JobClassController::class, 'deletePermanent'])->name('jobclass.delete-permanent');
Route::get('/ajax/jobclass/search', [JobClassController::class, 'ajaxSearch']);
Route::resource('jobclass', JobClassController::class);

//Route Skill
Route::get('/artikel/skill/{skill:slug}', [SkillController::class, 'skill'])->name('artikel.skill');

Route::get('/skill/published', [SkillController::class, 'published'])->name('skill.published');

Route::get('/skill/trash', [SkillController::class, 'trash'])->name('skill.trash');
Route::get('/skill/{id}/restore', [SkillController::class, 'restore'])->name('skill.restore');
Route::delete('/skill/{skill}/delete-permanent', [SkillController::class, 'deletePermanent'])->name('skill.delete-permanent');
Route::get('/ajax/skill/search', [SkillController::class, 'ajaxSearch']);
Route::resource('skill', SkillController::class);

//Route Quest
Route::get('/quest/published', [QuestController::class, 'published'])->name('quest.published');

Route::get('/quest/trash', [QuestController::class, 'trash'])->name('quest.trash');
Route::post('/quest/{quest}/restore', [QuestController::class, 'restore'])->name('quest.restore');
Route::delete('/quest/{quest}/delete-permanent', [QuestController::class, 'deletePermanent'])->name('quest.delete-permanent');
Route::resource('quest', QuestController::class);

//Route OrderQ
// order quest ke user
Route::get('/quest/siswa/{id}/order', [OrderQController::class, 'siswa'])->name('orderq.siswa');
Route::get('/quest/siswa/{id}/upload', [OrderQController::class, 'upload'])->name('orderq.upload');
Route::put('/quest/siswa/{id}/{quest_id}/update', [OrderQController::class, 'updateJawaban'])->name('orderq.updateJawaban');
Route::post('/quest/published/orderq/{id}/tambah', [OrderQController::class, 'tambahOrderQuest'])->name('orderq.tambahOrderQuest');
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

Route::get('/artikel/published', [ArtikelController::class, 'published'])->name('artikel.published');
Route::get('/artikel/published/{artikel:slug}', [ArtikelController::class, 'lihatArtikel'])->name('artikel.lihatArtikel');


Route::get('/artikel/trash', [ArtikelController::class, 'trash'])->name('artikel.trash');
Route::post('/artikel/{artikel}/restore', [ArtikelController::class, 'restore'])->name('artikel.restore');
Route::delete('/artikel/{artikel}/delete-permanent', [ArtikelController::class, 'deletePermanent'])->name('artikel.delete-permanent');
// Route::post('news/upload', [ArtikelController::class, 'upload'])->name('news.upload');
Route::resource('artikel', ArtikelController::class);

//Route Notifikasi
Route::get('/notifikasi/trash', [NotifikasiController::class, 'trash'])->name('notifikasi.trash');
Route::post('/notifikasi/{notifikasi}/restore', [NotifikasiController::class, 'restore'])->name('notifikasi.restore');
Route::delete('/notifikasi/{notifikasi}/delete-permanent', [NotifikasiController::class, 'deletePermanent'])->name('notifikasi.delete-permanent');
Route::resource('notifikasi', NotifikasiController::class);


//Route Quest
Route::get('/reward/trash', [RewardController::class, 'trash'])->name('reward.trash');
Route::post('/reward/{reward}/restore', [RewardController::class, 'restore'])->name('reward.restore');
Route::delete('/reward/{reward}/delete-permanent', [RewardController::class, 'deletePermanent'])->name('reward.delete-permanent');
Route::resource('reward', RewardController::class);

//Route OrderR
Route::resource('orderr', OrderRController::class);
