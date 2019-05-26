<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostviewTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER postview_trigger AFTER INSERT ON `posts` FOR EACH ROW
            BEGIN
            INSERT INTO `mostvisited` VALUES(null,NEW.title,NEW.media,NEW.content,1,NULL,NEW.vote,NEW.user_id,NEW.comunity_id,NOW(),NOW());
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `postview_trigger`');
    }
}
