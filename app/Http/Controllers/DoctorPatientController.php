<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Doctor;
use App\Patient;
use App\Http\Requests\DoctorPatientRequest;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

class DoctorPatientController extends Controller {

	public function __construct(){
		$this->middleware('auth.basic.once',['only'=>['store','update','destroy']]);
	}
	
	public function index($id)
	{
		$doctor = Doctor::find($id);

		if(!$doctor){
			return response()->json(['message'=>'There is no such Doctor','code'=>404],404);
		}
		else
			return response()->json(['data'=>$doctor->patient],200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(DoctorPatientRequest $request, $id)
	{
		$newpatient = $request->all();
		$doctor = Doctor::find($id);

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>'404'],Response::HTTP_NOT_FOUND);
		}

		$doctor->patient()->create($newpatient);

		return response()->json(['Patient created'],Response::HTTP_CREATED);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $idDoctor, $idPatient)
	{
		$methodR = $request->method();
		$doctor = Doctor::find($idDoctor);
		$flag = false;

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$patient = $doctor->patient()->find($idPatient);

		if(!$patient){
			return response()->json(['message'=>'The patient is not associated with the doctor','code'=>404],404);
		}

		$email = $request->input('Mail');
		$name = $request->input('Name');
		$age = $request->input('Age');
		$address = $request->input('PermanentAddress');
		$phone = $request->input('PhoneNumber');

		if($methodR == 'PATCH'){

			if($email!=null && $email != ''){
				$patient->Mail = $email;
				$flag = true;
				
			}

			if($name!=null && $name != ''){
				$patient->Name = $name;
				$flag = true;
			}

			if($age!=null && $age != ''){
				$patient->Age = $age;
				$flag = true;
			}

			if($address!=null && $address != ''){
				$patient->PermanentAddress = $address;
				$flag = true;
			}

			if($phone!=null && $phone != ''){
				$patient->PhoneNumber = $phone;
				$flag = true;
			}

			if($flag == true){
				$patient->save();
				return response()->json(['message'=>'The patient was updated'],200);
			}
			else
				return response()->json(['message'=>'Nothing to update'],200);
		}


		if(!$email || !$name || !$age || !$address || !$phone){
			return response()->json(['message'=>'We were unavailable to process the data','code'=>422],422);
		}

		$patient->Name = $name;
		$patient->Age = $age;
		$patient->Mail = $email;
		$patient->PermanentAddress = $address;
		$patient->PhoneNumber = $phone;

		$patient->save();
		return response()->json(['message' => 'The patient was updated'],200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($idDoctor, $idPatient)
	{
		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$patient = $doctor->patient()->find($idPatient);

		if(!$patient){
			return response()->json(['message'=>'The patient is not associated with the doctor','code'=>404],404);
		}

		$patientrecords = $patient->clinicalrecordP;
		$patientdiet = $patient->diet;
		$patientappointment = $patient->appointment;


		if(sizeof($patientrecords)+sizeof($patientdiet)+sizeof($patientappointment)>0){
			return response()->json(['message'=>'These patient have records, delete them first','code'=>409],409);
		}

		$patient->delete();
		return response()->json(['message' => 'The patient was deleted'],200);
	}

}
