<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('about','AboutController@about');
Route::resource('doctor','DoctorController');
Route::resource('patient','PatientController',['only'=>['index','show']]);
Route::resource('doctor.patient', 'DoctorPatientController',['except'=>['show']]);
Route::resource('diet','DietController',['only'=>['index','show']]);
Route::resource('doctor.diet','DoctorDietController',['except'=>['show']]);
Route::resource('patient.diet','PatientDietController',['only'=>['index']]);
Route::resource('diet.recipe','DietRecipeController',['only'=>['index']]);
Route::resource('doctor.recipe', 'DoctorRecipeController',['except'=>['show']]);
Route::resource('doctor.appointment','DoctorAppointmentController',['except'=>['show']]);
Route::resource('patient.appointment','PatientAppointmentController',['only'=>['index']]);
Route::resource('patient.clinicalrecord','PatientClinicalRecordController',['only'=>['index']]);
Route::resource('doctor.clinicalrecord','DoctorClinicalRecordController',['except'=>['show']]);

Route::pattern('unavailable','.*');
Route::any('/{unavailable}',function(){
 return response()->json(['message'=>'Route or method incorrect','code'=>400],400);
});

