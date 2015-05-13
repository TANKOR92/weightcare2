<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Crypt;
use App\Patient;
use App\Appointment;
use App\Diet;

class Doctor extends Model {


	protected $table = 'doctor';
	protected $primaryKey = 'idDoctor';
	
	protected $fillable = array('ProfessionalLicense','Name','PermanentAddress',
								'PhoneNumber','Mail');

	protected $hidden = ['created_at','updated_at','remember_token'];


	public function diet(){
		return $this->hasMany('App\Diet');
	}

	public function appointment(){
		return $this->hasMany('App\Appointment');
	}

	public function patient(){
		return $this->hasMany('App\Patient');
	}

	public function recipe(){
		return $this->hasMany('App\Recipe');
	}

	public function clinicalrecord(){
		return $this->hasMany('App\ClinicalRecord');
	}

}