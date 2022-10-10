<?php

use Illuminate\Support\Facades\Route;
// Brand CRUD
Route::group(['prefix' => 'customer'], function () {

    // Category index page
    Route::get('/', 'CustomerController@index')->name('customer.index');
    Route::get('/create', 'CustomerController@create')->name('customer.create');
    Route::post('/store', 'CustomerController@store')->name('customer.store');
    Route::get('/destroy/{id}', 'CustomerController@destroy')->name('customer.delete');
    Route::get('/edit/{id}', 'CustomerController@edit')->name('customer.edit');
    Route::patch('/update/{id}', 'CustomerController@update')->name('customer.update');
});