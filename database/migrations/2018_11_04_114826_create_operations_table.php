<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('operations', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('machine_id')->nullable();
      $table->integer('count_id')->nullable();
      $table->integer('cash');
      $table->enum('type', [0, 1, 2]);
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
    Schema::dropIfExists('operations');
  }
}
