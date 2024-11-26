<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 50)->unique();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
            $table->string('code_id')->nullable();
            $table->dateTime('expired_id')->nullable();
            $table->boolean('isActive')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}