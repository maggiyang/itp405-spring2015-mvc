<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class Dvd extends Model {

	public function genre(){
		return $this->belongsTo('App\Models\Genre'); 
	}
}