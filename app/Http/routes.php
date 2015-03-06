<?php

use App\Models\Dvd;
use App\Models\GenreDvd;

Route::get('/', 'WelcomeController@index');


Route::get('/dvds/search', 'DVDController@search');
Route::get('/dvds/create','DvdController@create');
Route::get('/dvds','DVDController@results');
Route::get('/dvds/{id}','DVDController@getDetails');
Route::post('/dvds/review','DVDController@review');
Route::post('/dvds/submitrequest','DvdController@submitCreateRequest');
Route::get('/genres/{genre_name}/dvds', function($genre_name){
    $genre = GenreDvd::where('genre_name', '=', $genre_name)->pluck('id');

    $movies = Dvd::with('genre', 'rating', 'label')->where('genre_id', '=', $genre)->get();

    return view('resultsbygenre',[
        'movies' => $movies,
        'genre_name' => $genre_name
    ]);
});