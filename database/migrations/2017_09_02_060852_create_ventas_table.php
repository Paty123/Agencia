<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('ventas', function(Blueprint $table) {
            $table->increments('id');
            $table->datetime('fechadecompra');
            $table->string('mediodepago');
            $table->string('imagen');
            $table->decimal('total');
            $table->decimal('descuento');
            $table->string('estado');
            $table->integer('agente_id')->unsigned();
            $table->foreign('agente_id')->references('id')->on('users');
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
       Schema::drop('ventas');
    }
}
