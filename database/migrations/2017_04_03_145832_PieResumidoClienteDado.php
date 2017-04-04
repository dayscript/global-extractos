<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PieResumidoClienteDado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portafolios',function(Blueprint $table){
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('fecha')->nullable();
          $table->string('retan_variable')->nullable();
          $table->string('retan_fija')->nullable();
          $table->string('operaciones_de_liquiez')->nullable();
          $table->string('operaciones_por_cumplir')->nullable();
          $table->string('saldo_disponible')->nullable();
          $table->string('total_cuenta_de_administracion')->nullable();
          $table->string('fondos_de_inversion_colectiva')->nullable();
          $table->string('gran_total')->nullable();
          $table->string('renta_fija_porcentaje')->nullable();
          $table->string('renta_variable_porcentaje')->nullable();
          $table->string('renta_fics_porcentaje')->nullable();
          $table->json('info_json');
          $table->timestamp('created_at')->nullable();
          $table->timestamp('updated_at')->nullable();
          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('portafolios');

    }
}
