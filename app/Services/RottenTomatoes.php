<?php namespace App\Services;
/**
 * Created by PhpStorm.
 * User: kush2
 * Date: 3/26/15
 * Time: 1:15 PM
 */

Class RottenTomatoes {
    public static function search($dvd_title)
    {
        if(\Cache::has("rt-$dvd_title"))
        {
            $json = \Cache::get("rt-$dvd_title");
        }
        else
        {
            //extracting json data for the movie mentioned
            $url = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=27uka9xff4p3h392tx249ffv&q='.urlencode($dvd_title);
            $json = file_get_contents($url);

            \Cache::put("rt-$dvd_title", $json, 60);
        }
        $rottentomatoes = json_decode($json);
        $movies = $rottentomatoes->movies;

        foreach ($movies as $movie) {
            if (trim(strtolower($movie->title)) == strtolower(trim(urldecode($dvd_title)))) {
                return $movie;
            }
        }

    }

}