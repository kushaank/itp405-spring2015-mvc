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
use Validator;

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

        return view('review',[
            'info' => $info,
            'reviews' => $reviews,
            'ratings' => $ratings

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
}
?>