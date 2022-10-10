<?php

use Illuminate\Support\Facades\Route;

Route::get('customer', 'CustomerController@welcome');

include('customer.php');