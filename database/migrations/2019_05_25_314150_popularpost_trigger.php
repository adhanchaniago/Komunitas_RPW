<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopularpostTrigger extends Migration {
    public function up() {
        DB::unprepared('
            CREATE TRIGGER most_visited AFTER UPDATE ON `posts` FOR EACH ROW
            BEGIN
            IF(NEW.view != OLD.view)
            THEN
                UPDATE `mostvisited` SET view = view + 1 WHERE title = OLD.title;
            END IF;
            END
        ');
    }
    
    public function down() {
        DB::unprepared('DROP TRIGGER `most_visited`');
    }
}
