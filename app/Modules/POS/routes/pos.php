<?php

use Illuminate\Support\Facades\Route;
// Brand CRUD
Route::group(['prefix' => 'pos'], function () {

    // Category index page
    // Route::get('/', 'CustomerController@index')->name('customer.index');
    Route::get('/create', 'POSController@create')->name('pos.create');
    Route::post('/store', 'POSController@ajaxStore')->name('customer.ajax.store');
    // Route::get('/destroy/{id}', 'CustomerController@destroy')->name('customer.delete');
    // Route::get('/edit/{id}', 'CustomerController@edit')->name('customer.edit');
    // Route::patch('/update/{id}', 'CustomerController@update')->name('customer.update');
    Route::get('/get-data/{id}', 'POSController@getData');
});