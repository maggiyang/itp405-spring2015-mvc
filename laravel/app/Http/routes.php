<?php


Route::get('/', 'WelcomeController@index');

Route::get('/dvds/search', 'DvdController@search');
Route::get('/dvds', 'DvdController@results');
