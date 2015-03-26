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
        if(\Cache::has("rottentomatoes-$dvd_title"))
        {
            $json = \Cache::get("rottentomatoes-$dvd_title");
            $rottentomatoes = json_decode($json);
        }

        else
        {
            //extracting json data for the movie mentioned
            $url = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=27uka9xff4p3h392tx249ffv&q='.urlencode($dvd_title);
            $json = file_get_contents($url);
            $rottentomatoes = json_decode($json);

            \Cache::put("rottentomatoes-$dvd_title", $json, 60);
        }



        foreach ($rottentomatoes->movies as $movie)
        {
            if (strtolower(trim($movie->title)) == strtolower(trim($dvd_title)))
            {
                return $movie;
            }
        }
        //return null;
    }

}