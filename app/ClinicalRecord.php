<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalRecord extends Model{

	protected $table = 'clinicalrecord';
	protected $primaryKey = 'idClinicalRecord';
	protected $fillable = array('patient_id','Weight','Size','Muscle','MetabolicAge','doctor_id');

	protected $hidden = ['created_at','updated_at'];
					

	public function patient(){
		return $this->belongsTo('App\Patient');
	}

	public function doctor(){
		return $this->belongsTo('App\Doctor');
	}							
	
}