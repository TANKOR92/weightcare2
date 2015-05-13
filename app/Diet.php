<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Diet extends Model{

	protected $table = 'diet';
	protected $primaryKey = 'idDiet';
	protected $fillable = array('doctor_id','patient_id','RecipeDate');

	protected $hidden = ['created_at','updated_at'];
								
	public function doctor(){
		return $this->belongsTo('App\Doctor');
	}

	public function patient(){
		return $this->belongsTo('App\Patient');
	}

	public function recipe(){
		return $this->hasMany('App\Recipe');
	}
								
	
}