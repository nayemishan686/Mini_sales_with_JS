<?php

use Illuminate\Support\Facades\Route;

Route::get('p-o-s', 'POSController@welcome');
include('pos.php');