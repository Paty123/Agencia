<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatecirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodoscir', function(Blueprint $table) {
            $table->increments('id');
            $table->date('desde');
            $table->date('hasta');
            $table->integer('circuito_id')->unsigned();
            $table->foreign('circuito_id')->references('id')->on('circuitos');
            $table->integer('opendate');
            $table->integer('minperson');

             $table->timestamps();
        });
        Schema::create('costoscir', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('costo',6,2);
            $table->string('personatipo');
            $table->integer('periodocir_id')->unsigned();
            $table->foreign('periodocir_id')->references('id')->on('periodoscir');
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
        Schema::drop('costoscir');
        Schema::drop('periodoscir');
    }
}
