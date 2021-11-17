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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::post('/first', 'HomeController@first');
Route::post('/first-yes', 'HomeController@firstYes');
Route::post('/first-no', 'HomeController@firstNo');

Route::post('/second-product', 'HomeController@secondProduct');
Route::post('/second-product-check', 'HomeController@secondProductCheck');

Route::post('/second-organic', 'HomeController@secondOrganic');
Route::post('/second-organic-check', 'HomeController@secondOrganicCheck');


Route::post('/ending', 'HomeController@ending');





