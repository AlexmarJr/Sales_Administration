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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/clients', 'HomeController@clients')->name('clients');
Route::post('/clients_save', 'HomeController@store_clients')->name('store_clients');
Route::post('/sale_save', 'HomeController@store_sales')->name('store_sales');
Route::get('delete/{id?}','HomeController@delete')->name('delete');
Route::any('client_details/{id?}','HomeController@client_details')->name('client_details');
Route::any('clients_search','HomeController@search_clients')->name('search_clients');

Route::any('sales_details/{id?}','HomeController@sales_details')->name('sales_details');
Route::any('sales_delete/{id?}','HomeController@delete_sales')->name('delete_sales');
Route::any('payment','HomeController@payment')->name('payment');

Route::get('payment/payoff{id?}', 'HomeController@payoff')->name('payoff');

//Geral Routes

Route::get('/indexGeral', 'HomeController@indexGeral')->name('indexGeral');