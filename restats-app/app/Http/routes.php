<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * The home page */
Route::get('/', ['middleware' => 'prevent', 'uses' => 'PagesController@home']);
Route::get('home', ['middleware' => 'prevent', 'uses' => 'PagesController@home']);

/**
 * Pages after login in
 */
//Route::resource('items', 'SalesItemsController');
Route::get('items', 'SalesItemsController@index');
Route::get('items/details', 'SalesItemsController@detail');

/**
 * Authentication
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);