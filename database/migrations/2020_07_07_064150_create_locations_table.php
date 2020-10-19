<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('locations', function (Blueprint $table) {
      $table->id();
      $table->string('name', 256); 
      $table->tinyInteger('type');

      // Location and meta
      $table->unsignedBigInteger('parent_id')->nullable()->references('id')->on('locations');

      $table->string('address', 256)->nullable();

      // MP = M(ap) P(provider) such as OSM, Mapbox, MazeMap, etc.
      $table->string('mp_id', 50)->nullable();
      $table->decimal('mp_lat', 10, 8)->nullable();
      $table->decimal('mp_lng', 11, 8)->nullable();
      
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
    Schema::dropIfExists('locations');
  }
}