<?php

use Illuminate\Support\Facades\Route;

// Route::get('products', 'ProductController@welcome');
// Brand CRUD
Route::group(['prefix' => 'brand'], function () {

    // Brand index page
    Route::get('/', 'BrandController@index')->name('brand.index');
    Route::get('/create', 'BrandController@create')->name('brand.create');
    Route::post('/store', 'BrandController@store')->name('brand.store');
    Route::get('/destroy/{id}', 'BrandController@destroy')->name('brand.delete');
    Route::get('/edit/{id}', 'BrandController@edit')->name('brand.edit');
    Route::post('/update/{id}', 'BrandController@update')->name('brand.update');
});
