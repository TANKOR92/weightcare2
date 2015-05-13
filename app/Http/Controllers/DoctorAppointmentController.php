<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Appointment;
use App\Doctor;


class DoctorAppointmentController extends Controller {

	public function __construct(){
		$this->middleware('auth.basic.once',['only'=>['store','update','destroy']]);
	}
	
	public function index($idDoctor)
	{
		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'There is no such doctor','code'=>404],404);
		}
		else
			return response()->json(['data'=>$doctor->appointment],200);
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
	public function store(Request $request, $idDoctor)
	{
		if(!$request->input('AppDate') || !$request->input('patient_id')){

			return response()->json(['message'=>'The appointment was not created','code'=>422],422);
		}

		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'There is no such doctor','code'=>404],404);
		}
		
		$doctor->appointment()->create($request->all());
		return response()->json(['message' => 'Appointment created'],201);
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
	public function update(Request $request, $idDoctor, $idAppointment)
	{
		$methodR = $request->method();
		$doctor = Doctor::find($idDoctor);
		$flag = false;

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$appointment = $doctor->appointment()->find($idAppointment);

		if(!$appointment){
			return response()->json(['message'=>'The appointment is not associated with the doctor','code'=>404],404);
		}

		$date = $request->input('AppDate');
		$patientid = $request->input('patient_id');

		if($methodR == 'PATCH'){

			if($date !=null && $date != ''){
				$appointment->AppDate = $date;
				$flag = true;
				
			}

			if($patientid !=null && $patientid != ''){
				$appointment->patient_id = $patientid;
				$flag = true;
			}

			if($flag == true){
				$appointment->save();
				return response()->json(['message'=>'The appointment was updated'],200);
			}
			else
				return response()->json(['message'=>'Nothing to update'],200);
		}


		if(!$date || !$patientid){
			return response()->json(['message'=>'We were unavailable to process the data','code'=>422],422);
		}

		$appointment->AppDate = $date;
		$appointment->patient_id = $patientid;

		$appointment->save();
		return response()->json(['message' => 'The appointment was updated'],200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($idDoctor, $idAppointment)
	{
		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$appointment = $doctor->appointment()->find($idAppointment);

		if(!$appointment){
			return response()->json(['message'=>'The appointment is not associated with the doctor','code'=>404],404);
		}

		$appointment->delete();
		return response()->json(['message' => 'The appointment was deleted'],200);
	}

}
