<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatetouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodosts', function(Blueprint $table) {
            $table->increments('id');
            $table->date('desde');
            $table->date('hasta');
            $table->integer('tour_id')->unsigned();
            $table->foreign('tour_id')->references('id')->on('tours');
            $table->integer('opendate');
            $table->integer('minperson');

             $table->timestamps();
        });
        Schema::create('costosts', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('costo',6,2);
            $table->string('personatipo');
            $table->integer('periodot_id')->unsigned();
            $table->foreign('periodot_id')->references('id')->on('periodosts');
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
        Schema::drop('costosts');
        Schema::drop('periodosts');
    }
}
