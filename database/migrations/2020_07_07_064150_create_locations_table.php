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
      $table->string('name', 50);
      $table->tinyInteger('type');
      $table->unsignedBigInteger('parent_id')->nullable()->references('id')->on('locations');
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent();
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
