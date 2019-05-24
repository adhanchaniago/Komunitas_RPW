<?php

use Illuminate\Database\Seeder;

class eventcomunityTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // DB::table('eventcomunity')->insert([
        // 	['event_id'=>1,'comunity_id'=>1],
        // 	['event_id'=>1,'comunity_id'=>4],
        // 	['event_id'=>1,'comunity_id'=>10],
        // 	['event_id'=>2,'comunity_id'=>1],
        // 	['event_id'=>2,'comunity_id'=>2],
        // ]);
        factory(App\EventComunity::class,300)->create();
    }
}
