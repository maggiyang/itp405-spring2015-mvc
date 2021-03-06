<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Models\DvdQuery;
use Validator;
use App\Models\Dvd; 
use App\Models\Label;
use App\Models\Sound;
use App\Models\Rating;
use App\Models\Genre;
use App\Models\Format;
use App\Services\RottenTomatoes; 

class DvdController extends Controller{
	public function search(Request $request){
		
		$genres = DB::table('genres')->get();
		$ratings = DB::table('ratings')->get(); 
		$genress = Genre::all(); 
		
		return view('dvdsearch', [
		'genres' => $genres,
		'ratings' => $ratings,
		'genress' => $genress
			
		]);
	}
	
	public function dvdByGenre($genre_name){
//		$dvds = Dvd::with(['genre' => function($query) use ($genre_name{
//			$query->where('genre->genre_name', 'like', '%'.$genre_name.'%');
//		}])->get(); 
		
		$dvds = Dvd::with('genre', 'label', 'rating')
			->whereHas('genre', function($query) use ($genre_name){
				$query->where('genre_name', '=', $genre_name);
			})->get(); 
//		
//		dd($dvds);
//		$dvds = Dvd::with('genre')->get(); 
		
//		var_dump($dvds->toArray()); 
		
		return view('dvdbygenre', [
			'genre' => $genre_name,
			'dvds' => $dvds
		]);
	}
	
	public function results(Request $request){
			
		$query= new DvdQuery(); 
	  	$dvds = $query->search($request->input('dvd_title'), $request->input('genre_id'), $request->input('rating_id')); 
		
		$genre_name = $query->getGenre($request->input('genre_id')); 
		$rating_name = $query->getRating($request->input('rating_id')); 
		
		return view('dvdresults', [
			'dvd_title' => $request->input('dvd_title'),
		  	'rating_id' => $request->input('rating_id'),
		  	'genre_id' => $request->input('genre_id'),
			'rating_name' => $rating_name,
			'genre_name' => $genre_name, 
			'dvds' => $dvds
			
		]); 
	}
	
	public function viewReview($id){
		
		
		$query = new DvdQuery(); 
		$dvd = $query->getDvd($id); 
		$reviews = $query->getReviews($id);
		
		$title = explode(" ", $dvd->title); 
		$titleSearch = implode("+", $title); 
		
		$rottentomatoes = new RottenTomatoes();
		$jsonString = $rottentomatoes->search($titleSearch); 
		
		
		$dvds = json_decode($jsonString);
		$dvdData = null;
		
		if(array_key_exists("movies", $dvds)){
			$dvds = $dvds->movies; 
			foreach($dvds as $d){
				if((strcasecmp($d->title, $dvd->title) >= -1 || (strcasecmp($d->title, $dvd->title) <= 1))&& $d->mpaa_rating == $dvd->rating_name){
					$dvdData = $d;
					break;
				}
			}
		}
		return view('dvdreview', [
			'dvd_id' => $id,
			'dvd' => $dvd,
			'reviews' => $reviews,
			'dvdData' => $dvdData	
		]); 
		
		
		
		
		
		

	}
	
	public function addReview(Request $request){
		 
		$validation = Validator::make($request->all(), [
			'review_title' => 'required|min:5',
			'review_rating' => 'required|numeric|between:1,10',
			'review_description' => 'required|min:20',
			'review_dvdid' => 'required|integer'
		]); 
		
		if($validation->passes()){
			$title=$request->input('review_title'); 
			$description=$request->input('review_description'); 
			$id=$request->input('review_dvdid');
			$rating =$request->input('review_rating');
			
			$db = new DvdQuery(); 
			$db->insertReview($title, $description, $id, $rating); 
			
			return redirect('dvds/'.$request->input('review_dvdid'))->with('success', 'Your review was successfully submitted!'); 
		}else{
			return redirect('/dvds/'. $request->input('review_dvdid'))
				->withInput()
				->withErrors($validation); 
		}
	}
	
	public function create(){
		$labels = Label::all(); 
		$sounds = Sound::all();
		$genres = Genre::all();
		$ratings = Rating::all(); 
		$formats = Format::all();
		 
		
		return view('newdvd',[
			'labels' => $labels,
			'sounds' => $sounds,
			'genres' => $genres,
			'ratings' => $ratings,
			'formats' => $formats
		]); 
	}
	
	public function newDvd(Request $request){ 
		
		$validation = Validator::make($request->all(), [
			'title' => 'required|min:5',
			'label' => 'required|integer',
			'sound' => 'required|integer',
			'genre' => 'required|integer',
			'rating' => 'required|integer',
			'format' => 'required|integer'
		]); 
		
		if($validation->passes()){
			$dvd = new Dvd();
			$dvd->title = $request->input('title'); 
			$dvd->label_id = $request->input('label'); 
			$dvd->sound_id = $request->input('sound'); 
			$dvd->genre_id = $request->input('genre'); 
			$dvd->rating_id = $request->input('rating'); 
			$dvd->format_id = $request->input('format');
			$dvd->save(); 
			
			return redirect('dvds/create')->with('success', 'Dvd was successfully added!'); 
		}else{
			return redirect('/dvds/create')
//				->withInput()
				->withErrors($validation); 
		}
	}
	
}



?>