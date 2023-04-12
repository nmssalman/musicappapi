<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('song_id')->unique();
            $table->string('title');
            $table->string('description');
            $table->string('demo_uuid');
            $table->string('song_uuid');
            $table->bigInteger('album_id');
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
        Schema::dropIfExists('songs');
    }  //
    
};
