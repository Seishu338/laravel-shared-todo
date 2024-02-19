<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TodoController::class, 'index'])->middleware(['auth', 'verified']);
Auth::routes(['verify' => true]);

Route::resource('todos', TodoController::class)->only(['index', 'store', 'update', 'destroy'])->middleware(['auth', 'verified']);
Route::get('todos/{todo}/addmytodo', [TodoController::class, 'addmytodo'])->name('todos.addmytodo');
Route::get('todos/{todo}/done', [TodoController::class, 'done'])->name('todos.done');
Route::get('todos/{todo}/returnshare', [TodoController::class, 'returnshare'])->name('todos.returnshare');

Route::resource('groups', GroupController::class)->only(['create', 'store'])->middleware(['auth', 'verified']);
Route::resource('tags', TagController::class)->only(['store', 'destroy'])->middleware('auth', 'verified');

Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage')->middleware(['auth', 'verified']);
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
});

Route::controller(GroupController::class)->group(function () {
    Route::get('users/mypage/groups', 'index')->name('mypage.groups');
    Route::get('users/mypage/groups/{group}/edit', 'edit')->name('mypage.groups.edit');
    Route::put('users/mypage/groups/{group}', 'update')->name('mypage.groups.update');
    Route::get('users/mypage/groups/{group}/destroy', 'destroy')->name('mypage.groups.destroy');
});
