<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->unique(); 
            $table->string('password'); 
            $table->string('avatar', 255)->nullable();
            $table->string('fullName', 50)->nullable(); 
            $table->string('nickName',50)->nullable(); 
            $table->string('code_id', 255)->nullable(); 
            $table->dateTime('expired_id')->nullable(); 
            $table->boolean('isActive')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
