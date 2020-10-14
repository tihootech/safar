<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/visa/upsert', 'VisaController@upsert');
Route::get('/visa/index', 'VisaController@index');
Route::get('/visa/get/{cid}', 'VisaController@getVisas');
Route::delete('/visa/{country}', 'VisaController@destroy');
Route::get('/country/get/{cid}', 'VisaController@getCountry');
