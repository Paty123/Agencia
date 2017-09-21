<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function(Blueprint $table) {
                $table->increments('id');
                $table->string('nombre');
                $table->string('direccion');
                $table->string('telefono');
                $table->string('correo');
                $table->string('personacontacto');
                $table->string('imagen');
                $table->text('descripcion');
                $table->boolean('publicado');
                $table->integer('estrellas');
                $table->integer('ciudad_id')->unsigned();
                $table->foreign('ciudad_id')->references('id')->on('ciudades');
                $table->timestamps();
            });
        Schema::create('periodosho', function(Blueprint $table) {
            $table->increments('id');
            $table->date('desde');
            $table->date('hasta');
            $table->decimal('costosupmenor',6,2);
            $table->timestamps();
            $table->integer('hotel_id')->unsigned();
            $table->foreign('hotel_id')->references('id')->on('hotels');
        });
        Schema::create('costosho', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('costo',6,2);
            $table->timestamps();
            $table->integer('periodoht_id')->unsigned();
            $table->foreign('periodoht_id')->references('id')->on('periodosho');
            $table->integer('habitacion_id')->unsigned();
            $table->foreign('habitacion_id')->references('id')->on('tipohabitaciones');
        });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('costosho');
        Schema::drop('periodosho');
        Schema::drop('hotels');
    }
}
