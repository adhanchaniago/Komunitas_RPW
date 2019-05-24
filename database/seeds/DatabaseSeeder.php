<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(UserTableSeeder::class);
        $this->call(ComunityTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(EventTableSeeder::class);
        $this->call(usercomunityTableSeeder::class);
        $this->call(eventcomunityTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        factory(App\Status::class,30)->create();
    }
}
