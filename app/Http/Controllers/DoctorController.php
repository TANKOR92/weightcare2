<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Doctor;

use Illuminate\Http\Request;

class DoctorController extends Controller {


	public function __construct(){
		$this->middleware('auth.basic.once',['only'=>['store','update','destroy']]);
	}

	public function index()
	{
		return response()->json(['data'=>Doctor::all()],200);
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
	public function store(Request $request)
	{
		if(!$request->input('Mail') || !$request->input('Name') || !$request->input('ProfessionalLicense')||
			!$request->input('PermanentAddress') || !$request->input('PhoneNumber')){
			return response()->json(['message'=>'The doctor was not created','code'=>422],422);
		}
		Doctor::create($request->all());
		return response()->json(['message' => 'Doctor created'],201);
	}

	public function show($id)
	{
		$doctor = Doctor::find($id);
		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}
		return response()->json(['data'=>$doctor],200);
	}

	public function edit($id)
	{

	}

	public function update(Request $request, $id)
	{
		$methodR = $request->method();
		$doctor = Doctor::find($id);
		$flag = false;

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$email = $request->input('Mail');
		$name = $request->input('Name');
		$license = $request->input('ProfessionalLicense');
		$address = $request->input('PermanentAddress');
		$phone = $request->input('PhoneNumber');

		if($methodR == 'PATCH'){

			if($email!=null && $email != ''){
				$doctor->Mail = $email;
				$flag = true;
			}

			if($name!=null && $name != ''){
				$doctor->Name = $name;
				$flag = true;
			}

			if($license!=null && $license != ''){
				$doctor->ProfessionalLicense = $license;
				$flag = true;
			}

			if($address!=null && $address != ''){
				$doctor->PermanentAddress = $address;
				$flag = true;
			}

			if($phone!=null && $phone != ''){
				$doctor->PhoneNumber = $phone;
				$flag = true;
			}

			if($flag == true){
				$doctor->save();
				return response()->json(['message'=>'The doctor was updated'],200);
			}

			return response()->json(['message'=>'Nothing to update'],200);
		}


		if(!$email || !$name || !$license || !$address || !$phone){
			return response()->json(['message'=>'We were unavailable to process the data','code'=>422],422);
		}

		$doctor->Name = $name;
		$doctor->ProfessionalLicense = $license;
		$doctor->Mail = $email;
		$doctor->PermanentAddress = $address;
		$doctor->PhoneNumber = $phone;

		$doctor->save();
		return response()->json(['message' => 'The doctor was updated'],200);
	}

	public function destroy($idDoctor)
	{
		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}
	
		$doctordiet = $doctor->diet;
		$doctorappointment = $doctor->appointment;
		$doctorpatient = $doctor->patient;
		$doctorrecipe = $doctor->recipe;
		$doctorrecord = $doctor->clinicalrecord;

		if(sizeof($doctordiet)+sizeof($doctorappointment)+sizeof($doctorrecipe)+sizeof($doctorrecord)>0){
			return response()->json(['message'=>'These doctor have records, delete them first','code'=>409],409);
		}

		$doctor->delete();
		return response()->json(['message' => 'The doctor was deleted'],200);
	}

}
