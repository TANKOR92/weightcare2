<?php

use Illuminate\Database\Seeder;
use App\Doctor;
use App\Patient;
use App\Diet;
use Faker\Factory as Faker;

class DietSeeder extends Seeder 
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		$countdoc = Doctor::all()->count();
		$countpatient = Patient::all()->count();

		 for($i = 0; $i<10; $i++)
		{
		 	Diet::create
		 	([
		 		'doctor_id'=> $faker->numberBetween(1,$countdoc),
		 		'patient_id'=>$faker->numberBetween(1,$countpatient),
		 		'RecipeDate' => $faker->dayOfWeek()
		 	]);
		}
	}
}