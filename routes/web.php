<?php

use Illuminate\Support\Facades\Route;
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


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'AdminController@index');
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@Login');
Route::get('admin/logout','AdminController@logout')->name('admin.logout');

//==================admin route ============================

//=====category crud start========
Route::get('admin/category/lists','Admin\CategoryController@index')->name('admin.category.lists');
Route::get('admin/category/create','Admin\CategoryController@create')->name('admin.category.create');
Route::post('admin/category/save','Admin\CategoryController@save')->name('admin.category.save');
Route::get('admin/category/edit/{categoryId}','Admin\CategoryController@edit')->name('admin.category.edit');
Route::post('admin/category/update','Admin\CategoryController@update')->name('admin.category.update');
Route::get('admin/category/delete/{id}','Admin\CategoryController@delete')->name('admin.category.delete');
//=====category crud end========