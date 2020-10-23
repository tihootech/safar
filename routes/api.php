<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// user account control
Route::get('user/current', 'AccController@currentUser');
Route::get('user/all', 'AccController@allUsers');
Route::post('user/change-activation-status/{user}', 'AccController@changeActivationStatus');
Route::put('user/update-password/{user}', 'AccController@updatePassword');
Route::put('user/{user}', 'AccController@updateUser');
Route::get('user/{user}', 'AccController@getUser');
Route::post('session/clear', 'AccController@deleteSession');

// country and visas
Route::post('/visa/upsert', 'VisaController@upsert');
Route::get('/visa/index', 'VisaController@index');
Route::get('/visa/all', 'VisaController@allVisas');
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
