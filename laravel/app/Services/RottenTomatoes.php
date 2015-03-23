<?php namespace App\Services; 

use \Cache; 

class RottenTomatoes{
	public function search($dvd_title){
		if(Cache::has("rottentomatoes-$dvd_title")){
			$jsonString = Cache::get("rottentomatoes-$dvd_title"); 
		}else{
			$url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=k6x5tb84gzs2zauymzrs3uzw&q=" . $dvd_title;
			$jsonString = file_get_contents($url);
			Cache::put("rottentomatoes-$dvd_title", $jsonString, 60); 
		}
		return $jsonString; 
	}
}

?>
