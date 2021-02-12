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



//==================admin route start==========================================================================

//=====category crud start========
Route::get('admin/category/lists','Admin\CategoryController@index')->name('admin.category.lists');
Route::get('admin/category/create','Admin\CategoryController@create')->name('admin.category.create');
Route::post('admin/category/save','Admin\CategoryController@save')->name('admin.category.save');
Route::get('admin/category/edit/{categoryId}','Admin\CategoryController@edit')->name('admin.category.edit');
Route::post('admin/category/update','Admin\CategoryController@update')->name('admin.category.update');
Route::get('admin/category/delete/{categoryId}','Admin\CategoryController@delete')->name('admin.category.delete');
Route::get('admin/category/inactive/{categoryId}','Admin\CategoryController@inactive');
Route::get('admin/category/active/{categoryId}','Admin\CategoryController@active');
//=====category crud end========

//=====brand crud start========
Route::get('admin/brand/lists','Admin\BrandController@index')->name('admin.brand.lists');
Route::get('admin/brand/create','Admin\BrandController@create')->name('admin.brand.create');
Route::post('admin/brand/save','Admin\BrandController@save')->name('admin.brand.save');
Route::get('admin/brand/edit/{brandId}','Admin\BrandController@edit')->name('admin.brand.edit');
Route::post('admin/brand/update','Admin\BrandController@update')->name('admin.brand.update');
Route::get('admin/brand/delete/{brandId}','Admin\BrandController@delete')->name('admin.brand.delete');
Route::get('admin/brand/inactive/{brandId}','Admin\BrandController@inactive');
Route::get('admin/brand/active/{brandId}','Admin\BrandController@active');
//=====brand crud end========

//=====product crud start========
Route::get('admin/product/lists','Admin\ProductController@index')->name('admin.product.lists');
Route::get('admin/product/create','Admin\ProductController@create')->name('admin.product.create');
Route::post('admin/product/save','Admin\ProductController@save')->name('admin.product.save');
Route::get('admin/product/edit/{productId}','Admin\ProductController@edit')->name('admin.product.edit');
Route::post('admin/product/update','Admin\ProductController@update')->name('admin.product.update');
Route::get('admin/product/delete/{productId}','Admin\ProductController@delete')->name('admin.product.delete');
Route::get('admin/product/inactive/{productId}','Admin\ProductController@inactive');
Route::get('admin/product/active/{productId}','Admin\ProductController@active');
//=====product crud end========

//==================admin route ends==========================================================================
