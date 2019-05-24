<?php

use Illuminate\Database\Seeder;

class ComunityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Comunity::class,30)->create();
    }
}
