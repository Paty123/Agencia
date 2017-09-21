<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircuitoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('circuitos', function(Blueprint $table) {
                $table->increments('id');
                $table->text('descripcion');
                $table->string('nombre');
                $table->string('imagen');
                $table->text('incluye');
                $table->text('noincluye');
                $table->text('terycond');
                $table->integer('ciudadsal_id')->unsigned();
                $table->foreign('ciudadsal_id')->references('id')->on('ciudades');
                $table->integer('ciudadllega_id')->unsigned();
                $table->foreign('ciudadllega_id')->references('id')->on('ciudades');
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
       Schema::drop('circuitos');
    }
}
