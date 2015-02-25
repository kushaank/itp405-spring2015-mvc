<?php


Route::get('/', 'WelcomeController@index');


Route::get('/dvds/search', 'DVDController@search');
Route::get('/dvds','DVDController@results');
Route::get('/dvds/{id}','DVDController@getDetails');
Route::post('/dvds/review','DVDController@review');

