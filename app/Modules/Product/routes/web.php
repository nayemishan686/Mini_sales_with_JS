<?php

use Illuminate\Support\Facades\Route;

Route::get('product', 'ProductController@welcome');

include('brand.php');
include('category.php');
