<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api.')->group(function(){
	Route::prefix('disciplinas')->group(function(){

		Route::get('/', 'DisciplinaController@index')->name('index_disciplinas');
		Route::get('/{id}', 'DisciplinaController@show')->name('single_disciplinas');

		Route::post('/', 'DisciplinaController@store')->name('store_disciplinas');
		Route::put('/{id}', 'DisciplinaController@update')->name('update_disciplinas');

		Route::delete('/{id}', 'DisciplinaController@delete')->name('delete_disciplinas');
	});
});
