<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Doctor;
use App\Recipe;

class DoctorRecipeController extends Controller {

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
			return response()->json(['data'=>$Doctor->recipe],200);
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
		if(!$request->input('Ingredients') || !$request->input('Image')|| !$request->input('Description')
			|| !$request->input('Calories') || !$request->input('diet_id')){

			return response()->json(['message'=>'The diet was not created','code'=>422],422);
		}

		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'There is no such doctor','code'=>404],404);
		}
		
		$doctor->recipe()->create($request->all());
		return response()->json(['message' => 'Recipe created'],201);
	}


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
	public function update(Request $request, $idDoctor, $idRecipe)
	{
		$methodR = $request->method();
		$doctor = Doctor::find($idDoctor);
		$flag = false;

		if(!$doctor){
			return response()->json(['message'=>'The doctor was not found','code'=>404],404);
		}

		$recipe = $doctor->recipe()->find($idRecipe);

		if(!$recipe){
			return response()->json(['message'=>'The recipe is not associated with the doctor','code'=>404],404);
		}

		$ingredients = $request->input('Ingredients');
		$dietid = $request->input('diet_id');
		$image = $request->input('Image');
		$description = $request->input('Description');
		$calories = $request->input('Calories');

		if($methodR == 'PATCH'){

			if($ingredients !=null && $ingredients != ''){
				$recipe->Ingredients = $ingredients;
				$flag = true;
				
			}

			if($dietid !=null && $dietid != ''){
				$recipe->diet_id = $dietid;
				$flag = true;
			}

			if($image !=null && $image != ''){
				$recipe->Image = $image;
				$flag = true;
			}

			if($description !=null && $description != ''){
				$recipe->Description = $description;
				$flag = true;
			}

			if($calories !=null && $calories != ''){
				$recipe->Calories = $calories;
				$flag = true;
			}

			if($flag == true){
				$recipe->save();
				return response()->json(['message'=>'The recipe was updated'],200);
			}
			else
				return response()->json(['message'=>'Nothing to update'],200);
		}


		if(!$ingredients || !$dietid || !$description || !$calories){
			return response()->json(['message'=>'We were unavailable to process the data','code'=>422],422);
		}

		$recipe->Ingredients = $ingredients;
		$recipe->diet_id = $dietid;
		$recipe->Image = $image;
		$recipe->Description = $description;
		$recipe->Calories = $calories;

		$recipe->save();
		return response()->json(['message' => 'The recipe was updated'],200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($idDoctor, $idRecipe)
	{
		$doctor = Doctor::find($idDoctor);

		if(!$doctor){
			return response()->json(['message'=>'There doctor was not found','code'=>404],404);
		}

		$recipe = $doctor->recipe()->find($idRecipe);

		if(!$recipe){
			return response()->json(['message'=>'The recipe is not associated with the doctor','code'=>404],404);
		}

		$recipe->delete();
		return response()->json(['message' => 'The recipe was deleted'],200);
	}

}
