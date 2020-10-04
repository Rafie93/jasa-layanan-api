<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // DB::table('users')->insert([
        //     'name' => 'Admin Admin',
        //     'email' => 'admin@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'no_telepon' => '082240300',
            
        //     'role'  => 1,
        //     'is_activated' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 1000; $i++){
    		DB::table('member')->insert([
                'user_id' => 0,
                'nama'=>$faker->name,
                'no_kartu' =>  $faker->unique()->numberBetween(5000,9000),
                'no_telepon' => $faker->phoneNumber,
                'tempat_lahir' =>$faker->address,
                'tanggal_lahir' =>  $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y-m-d'),
                'level' =>$faker->randomElement(['regular', 'premium']),
                'point' => $faker->randomNumber,
                'created_at' => $faker->dateTime()
    			
    		]);

    	}
    }
}
