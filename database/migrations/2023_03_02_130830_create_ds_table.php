<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ds', function (Blueprint $table) {
			$table->charset = 'utf8mb4';
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('uid');
			$table->integer('patient');
			$table->integer('ds')->default(0);
			$table->date('sdate')->nullable();
			$table->date('fdate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ds');
    }
}
