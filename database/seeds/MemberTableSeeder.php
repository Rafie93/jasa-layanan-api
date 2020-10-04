<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 50; $i++){
    		DB::table('member')->insert([
                'user_id' => 0,
                'nama'=>$faker->name,
                'no_kartu' => $faker->randomDigit,
                'no_telepon' => $faker->phoneNumber,
                'tempat_lahir' =>$faker->address,
                'tanggal_lahir' =>  $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y-m-d'),
                'level' =>$faker->randomElement(['regular', 'premium']),
                'point' => $faker->randomNumber,
                'created_at' => now()
    			
    		]);

    	}
    }
}
