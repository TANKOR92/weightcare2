<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model{

	protected $table = 'appointment';
	protected $primaryKey = 'idAppointment';
	protected $fillable = array('AppDate','doctor_id','patient_id');
	protected $hidden = ['created_at','updated_at'];

	public function doctor(){
		$this->belongsTo('Doctor');
	}

	public function patient(){
		$this->belongsTo('Patient');
	}

								
	
}