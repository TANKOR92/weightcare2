<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model{

	protected $table = 'recipe';
	
	protected $primaryKey = 'idRecipe';

	protected $fillable = array('Ingredients','Image','Description','Calories','diet_id','doctor_id');

	protected $hidden = ['created_at','updated_at'];
					

	public function diet(){
		return $this->belongsTo('App\Diet');
	}

	public function doctor(){
		return $this->belongsTo('App\Doctor');
	}							
	
}