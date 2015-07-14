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

/**
 * Pages after login in
 */
//Route::resource('items', 'SalesItemsController');
Route::group(['prefix' => 'home'], function()
{
    Route::get('/', 'SalesItemsController@index');
    Route::get('details', 'SalesItemsController@detail');
});


Route::group(['prefix' => 'home'], function()
{
    Route::get('/appetizers', 'DepartmentController@showAppetizers');
    Route::get('/bar', 'DepartmentController@showBar');
    Route::get('/dimsum', 'DepartmentController@showDimsum');
    Route::get('/entree_expensive', 'DepartmentController@showEntreeExpensive');
    Route::get('/entree_general', 'DepartmentController@showEntreeGeneral');
    Route::get('/luxury', 'DepartmentController@showLuxury');
    Route::get('/product', 'DepartmentController@showProduct');
    Route::get('/seafood', 'DepartmentController@showSeafood');
    Route::get('/soup', 'DepartmentController@showSoup');
});

/**
 * Authentication
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);