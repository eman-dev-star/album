<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
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
    return view('welcome');
});
Route::resource('albums',AlbumController::class);
Route::post('addimage',[AlbumController::class,'addimage'])->name('albums.addimage');
Route::get('allimage',[AlbumController::class,'allimage'])->name('albums.allimage');
Route::get('editimage',[AlbumController::class,'editimage'])->name('albums.editimage');
Route::put('image',[AlbumController::class,'image'])->name('albums.image');
Route::get('editalbum',[AlbumController::class,'editalbum'])->name('albums.editalbum');

Route::post('anotheralbum',[AlbumController::class,'anotheralbum'])->name('albums.anotheralbum');








