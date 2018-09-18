<?php

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

Route::get('/', 'PagesController@index');

Route::get('/welcome', function (){
    return view('welcome');
});

//Route::get('/user/{id}', function($id){
//    return 'This is ' . $id;
//});


Route::resource('problems','ProblemsController');
Route::resource('solutions','SolutionsController');
Route::resource('users','UsersController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
