<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class Genre extends Model {
	
	public function dvd(){
		return $this->hasMany('App\Models\Dvd'); 
	}

}