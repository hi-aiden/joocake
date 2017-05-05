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

Route::group(['namespace' => 'Home'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
});

/*
Route::get('/', function () {
    echo storage_path('app/public');
    return view('welcome');
});

Route::post('/upload_image', 'EditorController@uploadImage');

Route::group(['prefix' => 'admin'], function(){
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('board', 'BoardController');
});

*/
