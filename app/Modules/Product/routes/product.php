<?php

use Illuminate\Support\Facades\Route;
// Product CRUD
Route::group(['prefix' => 'product'], function () {

    // Category index page
    // Route::get('/', 'CategoryController@index')->name('category.index');
    Route::get('/create', 'CategoryController@create')->name('product.create');
    // Route::post('/store', 'CategoryController@store')->name('category.store');
    // Route::get('/destroy/{id}', 'CategoryController@destroy')->name('category.delete');
    // Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
    // Route::patch('/update/{id}', 'CategoryController@update')->name('category.update');
});
