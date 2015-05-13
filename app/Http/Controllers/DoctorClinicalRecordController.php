<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Doctor;

class DoctorClinicalRecordController extends Controller {

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
			return response()->json(['data'=>$doctor->clinicalrecord],200);
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
		if(!$request->input('Weight') || !$request->input('Size')|| !$request->input('MetabolicAge')
			|| !$request->input('patient_id') || !$request->input('Muscle')){

			return response()->json(['message'=>'The clinical record was not created','code'=>422],422);
		}

		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'There is no such doctor','code'=>404],404);
		}
		
		$doctor->clinicalrecord()->create($request->all());
		return response()->json(['message' => 'Clinical Record created'],201);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	public function update(Request $request, $idDoctor, $idRecord)
	{
		$methodR = $request->method();
		$doctor = Doctor::find($idDoctor);
		$flag = false;

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$record = $doctor->clinicalrecord()->find($idRecord);

		if(!$record){
			return response()->json(['message'=>'The clinical record is not associated with the doctor','code'=>404],404);
		}

		$weight = $request->input('Weight');
		$size = $request->input('Size');
		$muscle = $request->input('Muscle');
		$metaage = $request->input('MetabolicAge');
		$patientid = $request->input('patient_id');

		if($methodR == 'PATCH'){

			if($weight !=null && $weight != ''){
				$record->Weight = $weight;
				$flag = true;
				
			}

			if($size !=null && $size != ''){
				$record->Size = $size;
				$flag = true;
			}

			if($muscle !=null && $muscle != ''){
				$record->Muscle = $muscle;
				$flag = true;
			}

			if($metaage !=null && $metaage != ''){
				$record->MetabolicAge = $metaage;
				$flag = true;
			}

			if($patientid !=null && $patientid != ''){
				$record->patient_id = $patientid;
				$flag = true;
			}

			if($flag == true){
				$record->save();
				return response()->json(['message'=>'The clinical record was updated'],200);
			}
			else
				return response()->json(['message'=>'Nothing to update'],200);
		}


		if(!$weight || !$size || !$muscle || !$patientid){
			return response()->json(['message'=>'We were unavailable to process the data','code'=>422],422);
		}

		$record->Weight = $weight;
		$record->Size = $size;
		$record->Muscle = $muscle;
		$record->MetabolicAge = $metaage;
		$record->patient_id = $patientid;

		$record->save();
		return response()->json(['message' => 'The clinical record was updated'],200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($idDoctor, $idRecord)
	{
		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'There doctor was not found','code'=>404],404);
		}

		$record = $doctor->clinicalrecord()->find($idRecord);

		if(!$record){
			return response()->json(['message'=>'The clinical record is not associated with the doctor','code'=>404],404);
		}

		$record->delete();
		return response()->json(['message' => 'The clinical record was deleted'],200);
	}

}
