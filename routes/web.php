<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PagesController::class, 'homepage'])->name('homepage');

Route::get('contact', [PagesController::class, "contact_view"])->name('contact.page');
Route::post('contact', [PagesController::class, "contact_submit"])->name('contact.submit');

Route::get('/read/{slug}', [PagesController::class, 'post_view'])->name('read.post');
Route::get('/category/{slug}', [PagesController::class, 'category_view'])->name('category.view');
Route::get('search', [PagesController::class, 'search_posts'])->name('posts.search');


Route::post('comment/{slug}', [PagesController::class, 'new_comment'])->name('new.comment');
Route::post('like/{slug}', [PagesController::class, 'new_like'])->name('new.like');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin.check'])->prefix('admin')->group(function(){
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
});