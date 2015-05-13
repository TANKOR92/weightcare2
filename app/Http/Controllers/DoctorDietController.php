<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Diet;
use App\Doctor;
use App\Patient;

class DoctorDietController extends Controller {

	public function __construct(){
		$this->middleware('auth.basic.once',['only'=>['store','update','destroy']]);
	}
	
	public function index($idDoctor)
	{
		$Doctor = Doctor::find($idDoctor);

		if(!$Doctor){
			return response()->json(['message'=>'There is no such doctor','code'=>404],404);
		}
		else
			return response()->json(['data'=>$Doctor->diet],200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, $idDoctor)
	{
		if(!$request->input('RecipeDate') || !$request->input('patient_id')){

			return response()->json(['message'=>'The diet was not created','code'=>422],422);
		}

		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'There is no such doctor','code'=>404],404);
		}
		
		$doctor->diet()->create($request->all());
		return response()->json(['message' => 'Diet created'],201);
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $idDoctor, $idDiet)
	{
		$methodR = $request->method();
		$doctor = Doctor::find($idDoctor);
		$flag = false;

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$diet = $doctor->diet()->find($idDiet);

		if(!$diet){
			return response()->json(['message'=>'The diet is not associated with the doctor','code'=>404],404);
		}

		$date = $request->input('RecipeDate');
		$patientid = $request->input('patient_id');

		if($methodR == 'PATCH'){

			if($date !=null && $date != ''){
				$diet->RecipeDate = $date;
				$flag = true;
				
			}

			if($patientid !=null && $patientid != ''){
				$diet->patient_id = $patientid;
				$flag = true;
			}

			if($flag == true){
				$diet->save();
				return response()->json(['message'=>'The diet was updated'],200);
			}
			else
				return response()->json(['message'=>'Nothing to update'],200);
		}


		if(!$date || !$patientid){
			return response()->json(['message'=>'We were unavailable to process the data','code'=>422],422);
		}

		$diet->RecipeDate = $date;
		$diet->patient_id = $patientid;

		$diet->save();
		return response()->json(['message' => 'The diet was updated'],200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($idDoctor, $idDiet)
	{
		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$diet = $doctor->diet()->find($idDiet);

		if(!$diet){
			return response()->json(['message'=>'The diet is not associated with the doctor','code'=>404],404);
		}

		$dietrecipe = $diet->recipe;

		if(sizeof($dietrecipe)>0){
			return response()->json(['message'=>'These diet have recipes, delete them first','code'=>409],409);
		}

		$patient->delete();
		return response()->json(['message' => 'The diet was deleted'],200);
	}

}
