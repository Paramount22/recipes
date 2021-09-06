<?php

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

Auth::routes(['verify' => true]);
// Search
Route::get('queries', 'QueryController@search')->name('search'); //search

Route::get('/', 'RecipeController@index');

/*Users*/
Route::get('users/{user}/comments', 'UserController@showUserComments')->name('show.user.comments');
Route::get('users/{user}/change-password', 'UserController@change_password')->name('change.password');
Route::post('users/{user}/update-password', 'UserController@update_password')->name('update.password');
Route::resource('users', 'UserController');

/*Recipes*/
Route::get('recipes/restore/one/{recipe}', 'RecipeController@restore')->name('recipes.restore');
Route::get('recipes/restore_all', 'RecipeController@restore_all')->name('recipes.restore_all');
Route::resource('recipes', 'RecipeController');

/*Admin*/
Route::prefix('admin')->group(function () {
    Route::resource('categories', 'CategoryController')->except('show');
});

/*Categories*/
Route::resource('categories', 'CategoryController')->only('show');

/*Comments*/
Route::resource('comments', 'CommentController');
Route::post('comment/{comment}/likes', 'CommentLikeController@store')->name('comments.likes');
Route::post('comment/{comment}/unlikes', 'CommentUnlikeController@store')->name('comments.unlikes');


Route::get('/home', 'HomeController@index')->name('home');

