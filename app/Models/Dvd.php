<?php
/**
 * Created by PhpStorm.
 * User: kush2
 * Date: 2/17/15
 * Time: 1:20 AM
 */
namespace App\Models;
use DB;
use Validator;
use Illuminate\Database\Eloquent\Model;

class Dvd extends Model{

    public function getGenres() {
        $query = DB::table('genres')->orderBy('genre_name', 'asc');
        return $query->get();
    }

    public function getRatings() {
        $query = DB::table('ratings')->orderBy('rating_name','asc');
        return $query->get();
    }

    public static function getInfo($dvdId){
        $query = DB::table('dvds')
            ->where('dvds.id', '=' , $dvdId)
            ->select('*', 'dvds.id AS id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');
        return $query->get();
    }
    public function search($title, $genre, $rating) {
        $query = DB::table('dvds')->select('*', 'dvds.id AS id')
            ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
            ->join('genres', 'genres.id', '=', 'dvds.genre_id')
            ->join('labels', 'labels.id', '=', 'dvds.label_id')
            ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
            ->join('formats', 'formats.id', '=', 'dvds.format_id');
        if ($title) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
        if ($genre && $genre != 'All') {
            $query->where('genre_name', '=', $genre);
        }
        if ($rating && $rating != 'All') {
            $query->where('rating_name', '=', $rating);
        }
        $query->orderBy('title', 'asc');
        return $query->get();
    }

    public static function validate($input){
        return Validator::make($input, [
            'title' => 'required|min:5',
            'rating' => 'required|integer',
            'review' => 'required|min:20',
            'id' => 'required|integer'
        ]);
    }

    public static function writeReview($input){
        return DB::table('reviews')->insert($input);

    }

    public static function getReviews($id){
        $query= DB::table('reviews')->where('dvd_id', '=', $id);

        return $query->get();
    }


    public function label(){
        return $this->belongsTo('App\Models\LabelDvd');
    }

    public function genre(){
        return $this->belongsTo('App\Models\GenreDvd');
    }

    public function sound(){
        return $this->belongsTo('App\Models\SoundDvd','sound_id');
    }

    public function format(){
        return $this->belongsTo('App\Models\FormatDvd','format_id');
    }

    public function rating(){
        return $this->belongsTo('App\Models\RatingDvd');
    }

    public static function createDvd($info){

        return DB::table('dvds')->insert($info);
    }
    public static function validateInsertRequest($request){
        return Validator::make($request,[

            'title' => 'required|min:5',
            'genre' => 'required|integer',
            'label' => 'required|integer',
            'sound' => 'required|integer',
            'rating' => 'required|integer',
            'format' => 'required|integer'

        ]);
    }

}
?>