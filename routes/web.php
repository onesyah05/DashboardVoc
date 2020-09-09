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

Route::get('/', 'DashboardController@index');

Route::get('/reseller', 'DashboardController@Reseller');
Route::get('/report', 'DashboardController@Report');
Route::get('/stok', 'DashboardController@Stok');
Route::get('/product', 'DashboardController@Product');
Route::get('/user', 'DashboardController@User');

Route::get('/login', 'DashboardController@login');

Route::get('/logout', 'DashboardController@logout');

Route::post('/postReseller', 'DashboardController@postReseller');
Route::post('/postProduct', 'DashboardController@postProduct');
Route::post('/postStok', 'DashboardController@postStok');
Route::post('/postReport', 'DashboardController@postReport');
Route::post('/postUser', 'DashboardController@postUser');
Route::post('/postLogin', 'DashboardController@postLogin');

