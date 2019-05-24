<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	App\User::create([
    		'name' => 'Admin 1',
    		'role' => 'admin',
    		'email' => 'admin1@mail.com',
    		'username' => 'admin1',
    		'password' => Hash::make('12345678'),
    		'avatar' => 'avatars/1.png',
    	]);
        factory(App\User::class,30)->create();
    }
}
