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

Route::get('/', function () {
    return view('index');
})->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/generateInput','HomeController@generateInput')->name('generateInput');
Route::get('entry','HomeController@entry')->name('entry');
Route::get('detail/{id}','HomeController@detail')->name('detail');
Route::get('shedule','HomeController@schedules')->name('schedules');
Route::get('all_shedule','HomeController@allSchedules')->name('allSchedules');
Route::post('post_entry','HomeController@postEntry')->name('postEntry');
Route::post('add_surgeon','HomeController@addSurgeon')->name('addSurgeon');
Route::get('complet//{id}','HomeController@complete')->name('complete');
Route::get('cancel//{id}','HomeController@cancel')->name('cancel');
