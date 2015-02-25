<?php

Route::get('/', 'WelcomeController@index');

Route::get('/dvds/search', 'DvdController@search');
Route::get('/dvds', 'DvdController@results');

Route::get('/dvds/{id}', 'DvdController@viewReview');

Route::post('/dvds/addreview', 'DvdController@addReview'); 

?>