<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Models\DvdQuery;
use Validator; 

class DvdController extends Controller{
	public function search(Request $request){
		
		$genres = DB::table('genres')->get();
		$ratings = DB::table('ratings')->get(); 
		
		return view('dvdsearch', [
		'genres' => $genres,
		'ratings' => $ratings
			
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
		
		
		return view('dvdreview', [
			'dvd_id' => $id,
			'dvd' => $dvd,
			'reviews' => $reviews
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
			DB::table('reviews')->insert([
				'title' => $request->input('review_title'), 
				'description' => $request->input('review_description'),
				'dvd_id' => $request->input('review_dvdid'),
				'rating' => $request->input('review_rating')
			]);
			return redirect('dvds/'.$request->input('review_dvdid'))->with('success', 'Your review was successfully submitted!'); 
		}else{
			return redirect('/dvds/'. $request->input('review_dvdid'))
				->withInput()
				->withErrors($validation); 
		}
	}
	
}



?>