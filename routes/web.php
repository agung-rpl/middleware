<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;

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

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/about',[AboutController::class, 'index'])->name('about');
Route::get('/project',[ProjectController::class, 'project'])->name('project');
Route::get('/contact',[ContactController::class, 'contact'])->name('contact');

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'authenticate'])->name('login.auth');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/admin',[AdminController::class, 'index'])->name('admin');

    // siswa
    Route::get('/mastersiswa',[SiswaController::class, 'index'])->name('mastersiswa');


    // project
    Route::resource('/masterproject', ProjectController::class);
    Route::get('/masterproject/{id}/create',[ProjectController::class, 'add'])->name('project.add');


    Route::get('/mastercontact',[ContactController::class, 'index'])->name('mastercontact');
    Route::get('/mastercontact/{id}/edit',[ContactController::class, 'edit'])->name('mastercontact.edit');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/mastersiswa/create',[SiswaController::class, 'create'])->name('mastersiswa.create');
    Route::get('/mastersiswa/{id}/edit',[SiswaController::class, 'edit'])->name('mastersiswa.edit');
    Route::post('/mastersiswa',[SiswaController::class, 'store'])->name('mastersiswa.store');
    Route::put('/mastersiswa/{id}',[SiswaController::class, 'update'])->name('mastersiswa.update');
    Route::delete('/mastersiswa/{id}',[SiswaController::class, 'delete'])->name('mastersiswa.delete');

});




