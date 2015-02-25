<?php namespace App\Models;

use DB; 

class DvdQuery{
	public function search($title, $genre, $rating){  
		return DB::table('dvds')
		  ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
		  ->join('genres', 'genres.id', '=', 'dvds.genre_id')
		  ->join('labels', 'labels.id', '=', 'dvds.label_id')
		  ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
		  ->join('formats', 'formats.id', '=', 'dvds.format_id')
		  ->where('title', 'LIKE', '%' . $title . '%')
		  ->where(function($query) use ($genre, $rating){
		  		if($genre){
					$query->where('genre_id', '=', $genre);
				}
				if($rating){
					$query->where('rating_id', '=', $rating); 
				}
		  	})
		  ->orderBy('title', 'asc')
		  ->get(array(
			  	'dvds.id',
			  	'title',
			  	'rating_name',
			  	'genre_name',
			  	'label_name',
			  	'sound_name',
			  	'format_name',
			 	'release_date'
		  	)); 
	}
	
	public function getReviews($id){
		return DB::table('reviews')
			->where('dvd_id', '=', $id)
			->get(); 
	}
	
	public function getGenre($id){
		if($id == "0"){
			return "All";
		}
		
		$genre = DB::table('genres')
			->where('id', '=', $id)
			->get();
		
		foreach ($genre as $g){
			return $g->genre_name;
		}
	}
	
	public function getRating($id){
		if($id == "0"){
			return "All";
		}
		
		$rating = DB::table('ratings')
			->where('id', '=', $id)
			->get();
		
		foreach ($rating as $r){
			return $r->rating_name; 
		}
	}
	public function getDvd($id){
		$dvd = DB::table('dvds')
		  ->join('ratings', 'ratings.id', '=', 'dvds.rating_id')
		  ->join('genres', 'genres.id', '=', 'dvds.genre_id')
		  ->join('labels', 'labels.id', '=', 'dvds.label_id')
		  ->join('sounds', 'sounds.id', '=', 'dvds.sound_id')
		  ->join('formats', 'formats.id', '=', 'dvds.format_id')
		  ->where('dvds.id', '=', $id)
		  ->get(array(
			  	'dvds.id',
			  	'title',
			  	'rating_name',
			  	'genre_name',
			  	'label_name',
			  	'sound_name',
			  	'format_name',
			 	'release_date'
		  	));
		
		foreach ($dvd as $d){
			return $d; 
		}
	}
}

?>