<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/visa/store', 'VisaController@store');
Route::get('/visa/index', 'VisaController@index');
Route::get('/visa/get/{cid}', 'VisaController@getVisas');
