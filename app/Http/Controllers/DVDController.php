<?php
/**
 * Created by PhpStorm.
 * User: kush2
 * Date: 2/17/15
 * Time: 1:25 AM
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Dvd;
use App\Models\SoundDvd;
use App\Models\RatingDvd;
use App\Models\GenreDvd;
use App\Models\LabelDvd;
use App\Models\FormatDvd;
use App\Services\RottenTomatoes;

class DVDController extends Controller {

    public function search() {
        $genres = (new Dvd())->getGenres();
        $ratings = (new Dvd())->getRatings();

        return view('search', [
            'genres' => $genres,
            'ratings' => $ratings
        ]);
    }

    public function results(Request $request) {
        $title = $request->input('title');
        $genre = $request->input('genre');
        $rating = $request->input('rating');
        $movies = (new Dvd())->search($title, $genre, $rating);

        return view('results', [
            'title' => $title,
            'genre' => $genre,
            'rating' =>$rating,
            'movies' => $movies
        ]);
    }

    public static function getDetails($id)
    {
        $info = (Dvd::getInfo($id));

        $reviews = (Dvd::getReviews($id));
        $ratings = array("1", "2", "3", "4","5","6","7","8","9","10");
        $rottentomates = RottenTomatoes::search($info->title);

        return view('review',[
            'info' => $info,
            'reviews' => $reviews,
            'ratings' => $ratings,
            'rottentomatoes' => $rottentomates

        ]);
    }
    public function review(Request $request)
    {
        $validator = Dvd::validate($request->all());

        if($validator->passes())
        {
            Dvd::writeReview([
                'title' => $request->input('title'),
                'description' => $request->input('review'),
                'dvd_id' => $request->input('id'),
                'rating' => $request->input('rating')
            ]);

            return redirect('/dvds/'.$request->input('id'))->with('success','Review submitted');
        }

        return redirect('/dvds/'.$request->input('id'))->withInput()->withErrors($validator);
    }


    public function create(){

        return view('create',[
            'genres' => GenreDvd::all(),
            'labels' => LabelDvd::all(),
            'sounds' => SoundDvd::all(),
            'ratings' => RatingDvd::all(),
            'formats' => FormatDvd::all()
        ]);
    }
    public function submitCreateRequest(Request $request){

        $validator = Dvd::validateInsertRequest($request->all());
        if($validator->passes()){
            Dvd::createDvd([
                'title' => $request->input('title'),
                'genre_id' => $request->input('genre'),
                'label_id' => $request->input('label'),
                'sound_id' => $request->input('sound'),
                'rating_id' => $request->input('rating'),
                'format_id' => $request->input('format')
            ]);
            return redirect('/dvds/create')->with('success','Dvd inserted successfully!');
        }else{
            return redirect('/dvds/create')
                ->withInput()
                ->withErrors($validator);
        }
    }


}
?>