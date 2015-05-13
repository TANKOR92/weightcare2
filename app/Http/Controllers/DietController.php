<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Diet;

class DietController extends Controller {


	public function index()
	{
		return response()->json(['data'=>Diet::all()],200);
	}


	public function show($id)
	{
		$id = Diet::find($id);
		if(!$id){
			return response()->json(['message'=>'There is no such diet','code'=>404],404);
		}
		else
			return response()->json(['data'=>$id],200);
	}
}
