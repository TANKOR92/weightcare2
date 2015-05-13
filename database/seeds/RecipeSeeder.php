<?php

use Illuminate\Database\Seeder;
use App\Diet;
use App\Recipe;
use App\Doctor;
use Faker\Factory as Faker;

class RecipeSeeder extends Seeder 
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		$countdiet = Diet::all()->count();
		$countdoc = Doctor::all()->count();

		 for($i = 0; $i<$countdiet; $i++)
		{
		 	Recipe::create
		 	([
		 		'diet_id' => $faker->numberBetween(1,$countdiet),
		 		'doctor_id' => $faker->numberBetween(1,$countdoc),
		 		'Ingredients' => $faker->text($maxNbChars = 100),
		 		'Description' => $faker->text($maxNbChars = 200),
		 		'Calories' => $faker->numberBetween(600,2000),
		 		'Image' => 'image.jpg'
		 	]);
		}
	}
}