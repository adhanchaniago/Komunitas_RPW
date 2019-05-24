<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Comunity;
use Faker\Factory as Faker;

class usercomunityTableSeeder extends Seeder {
    public function run() {
    	// $faker = Faker::create();
    	// for ($i=0; $i < 200; $i++) { 
    	// 	DB::table('usercomunity')->insert([
    	// 		'comunity_id' => function(){
    	// 			return Comunity::all()->random();
    	// 		},
    	// 		'user_id' => function() {
     //    			return User::all()->random();
     //    		}
    	// 	]);
    	// }
        foreach (Comunity::all() as $key) {
            App\UserComunity::create([
                'user_id' => 1,
                'comunity_id'=>$key->id,
            ]);
        }
    	factory(App\UserComunity::class,1300)->create();
    }
}
