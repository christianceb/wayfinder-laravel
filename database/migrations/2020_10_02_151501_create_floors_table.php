<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable;
            $table->tinyInteger("order");
            $table->decimal('ne_lng', 11, 8)->nullable();
            $table->decimal('ne_lat', 10, 8)->nullable();
            $table->decimal('sw_lng', 11, 8)->nullable();
            $table->decimal('sw_lat', 10, 8)->nullable();
            $table->foreignId('upload_id')->constrained();
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
        Schema::dropIfExists('floors');
    }
}
