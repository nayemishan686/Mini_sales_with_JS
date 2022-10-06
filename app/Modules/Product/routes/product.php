<?php

use Illuminate\Support\Facades\Route;
// Product CRUD
Route::group(['prefix' => 'product'], function () {

    // Category index page
    Route::get('/', 'ProductController@index')->name('product.index');
    Route::get('/create', 'ProductController@create')->name('product.create');
    Route::post('/store', 'ProductController@store')->name('product.store');
    Route::get('/destroy/{id}', 'ProductController@destroy')->name('product.delete');
    Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::patch('/update/{id}', 'ProductController@update')->name('product.update');
    Route::get('/get-category/{id}', 'ProductController@getCategory');
});
