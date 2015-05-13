<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Patient;
use App\Diet;

class PatientDietController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($idPatient)
	{
		$patient = Patient::find($idPatient);

		if(!$patient){
			return response()->json(['message'=>'There is no such patient','code'=>404],404);
		}
		else
			return response()->json(['data'=>$patient->diet],200);
	}

}
