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
			Route::resource('users', 'UsersController', ['except' => ['create', 'update']]);
			Route::resource('contributors', 'ContributorsController', ['except' => ['create', 'update']]);
			Route::resource('invoices', 'InvoicesController', ['except' => ['create', 'update']]);
		});
	});
//});