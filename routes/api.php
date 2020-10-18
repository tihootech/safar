<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// country and visas
Route::post('/visa/upsert', 'VisaController@upsert');
Route::get('/visa/index', 'VisaController@index');
Route::get('/visa/get/{cid}', 'VisaController@getVisas');
Route::delete('/visa/{country}', 'VisaController@destroy');
Route::get('/country/get/{cid}', 'VisaController@getCountry');

// employee and agencies
Route::post('/agency/upsert', 'AgencyController@upsert');
Route::get('/agency/index', 'AgencyController@index');
Route::get('/employee/get/{aid}', 'AgencyController@getEmployees');
Route::delete('/agency/{agency}', 'AgencyController@destroy');
Route::get('/agency/get/{aid}', 'AgencyController@getAgency');

// gallery
Route::post('gallery/upload', 'GalleryController@upload');
Route::post('gallery/delete', 'GalleryController@clearFile');


// agency and users
