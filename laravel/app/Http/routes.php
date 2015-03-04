<?php

Route::get('/', 'WelcomeController@index');

Route::get('/dvds/search', 'DvdController@search');
Route::get('/genres/{genre_name}/dvds','DvdController@dvdByGenre');
Route::get('/dvds', 'DvdController@results');
Route::post('/dvds','DvdController@newDvd'); 

Route::get('/dvds/create', 'DvdController@create'); 

Route::get('/dvds/{id}', 'DvdController@viewReview');

Route::post('/dvds/addreview', 'DvdController@addReview'); 

?>