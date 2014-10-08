<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function(){
	return View::make('hello');
});


//Route::group(['domain' => 'api.cfdi'], function(){
	Route::group(['prefix' => 'v0', 'namespace' => 'Controllers\Api\V0'], function(){
		Route::group(['namespace' => 'Business'], function(){
			Route::resource('User', 'UserController', ['except' => ['create', 'update']]);
			Route::resource('Contributor', 'ContributorController', ['except' => ['create', 'update']]);
			Route::resource('Invoice', 'InvoiceController', ['except' => ['create', 'update']]);
		});
	});
//});