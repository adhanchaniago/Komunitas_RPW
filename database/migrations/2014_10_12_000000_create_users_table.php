<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('role',['member','admin']);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('avatar')->default('avatars/1.png');
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}
