<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\CommentUnlikeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\RecipeController;
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

Auth::routes();
// Search
Route::get('queries', [QueryController::class, 'search'])->name('search');

Route::get('/', [RecipeController::class, 'index']);

/*Users*/
Route::get('users/{user}/comments', [UserController::class, 'showUserComments'])
    ->name('show.user.comments');

Route::get('users/{user}/change-password', [UserController::class, 'changePassword'])
    ->name('change.password');

Route::post('users/{user}/update-password', [UserController::class, 'updatePassword'])
    ->name('update.password');

Route::resource('users', UserController::class);



/*Admin*/
Route::prefix('adminsystem')->middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('categories', CategoryController::class)->except('show');
    /* SoftDeletes Recipes */
    Route::get('recipes-soft-deletes', [RecipeController::class, 'getRecipes'])->name('recipes.softDeletes');
    Route::get('recipes/restore/one/{recipe}', [RecipeController::class, 'restore'])
        ->name('recipes.restore');
    Route::get('recipes/restore_all', [RecipeController::class, 'restoreAll'])
        ->name('recipes.restore_all');
    Route::delete('recipes/{id}/delete', [RecipeController::class, 'delete'])->name('recipes.delete');
    Route::post('recipes/{id}/force_delete', [RecipeController::class, 'forceDelete'])->name('recipes.force_delete');

});
/*Recipes*/
Route::get('all-recipes', [RecipeController::class, 'getAllRecipes'])->name('recipes.all');
Route::resource('recipes', RecipeController::class);

/*Categories*/
Route::resource('categories', CategoryController::class)->only('show');

/*Comments*/
Route::post('comment/{comment}/likes', [CommentLikeController::class, 'store'])->name('comments.likes');
Route::post('comment/{comment}/unlikes', [CommentUnlikeController::class, 'store'])
->name('comments.unlikes');
Route::resource('comments', CommentController::class);



Route::get('/home', [HomeController::class, 'index'])->name('home');

/*Admin panel*/
//Route::view('/admin', 'layouts.admin');
//Route::get('/admin/{any?}', function () {
//   return view('layouts.admin');
//})->where('any', '.*')->middleware('auth', 'is_admin')->name('admin');


