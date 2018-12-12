<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivelegesColumsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->boolean('archive')->default(1)->after('password');
        $table->boolean('find')->default(1)->after('archive');
        $table->boolean('report')->default(1)->after('find');
        $table->boolean('setting')->default(1)->after('report');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumm('archive');
        $table->dropColumm('find');
        $table->dropColumm('report');
        $table->dropColumm('setting');
      });
    }
}
