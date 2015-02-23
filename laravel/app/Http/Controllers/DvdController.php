<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use App\Models\DvdQuery;

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
	
}



?>