<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ClinicalRecord;
use App\Patient;

class PatientClinicalRecordController extends Controller {

	
	public function index($idPatient)
	{
		$patient = Patient::find($idPatient);

		if(!$patient){
			return response()->json(['message'=>'There is no such patient','code'=>404],404);
		}
		else
			return response()->json(['data'=>$patient->clinicalrecordP()],200);
	
	}

}
