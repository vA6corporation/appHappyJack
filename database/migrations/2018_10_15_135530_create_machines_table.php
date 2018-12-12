<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachinesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('machines', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name', 50);
      $table->string('game', 50);
      $table->enum('denominate', ['0.10', '1.0']);
      $table->string('maker', 50);
      $table->string('series', 50);
      $table->integer('position');
      $table->string('number', 50);
      $table->boolean('state')->default(0);
      $table->string('observation', 50)->nullable();
      $table->integer('lastTurnover')->default(0);
      $table->integer('lastTotalwin')->default(0);
      $table->integer('lastBill')->default(0);
      $table->date('lastReg')->nullable();
      $table->integer('count_id')->nullable();
      $table->integer('room_id')->nullable();
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
    Schema::dropIfExists('machines');
  }
}
