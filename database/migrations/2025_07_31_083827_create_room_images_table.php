<?php 

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Database\Schema\Blueprint; 
 use Illuminate\Support\Facades\Schema; 
 
 return new class extends Migration 
{ 
    
public function up()
{
    Schema::create('room_images', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('room_id');
        $table->string('image_path');
          $table->string('caption')->nullable();
        $table->timestamps();

        $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
    });
}

};