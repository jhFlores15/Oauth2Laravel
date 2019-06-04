<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotasCreditoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_credito', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cliente_id')->nullable();
            $table->string('cliente_name')->nullable();
            $table->bigInteger('factura');
            $table->string('descripcion');
            $table->string('cantidad')->nullable();
            $table->string('detalle');
            $table->bigInteger('monto')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->unsignedBigInteger('autorizadores_id');
            $table->foreign('autorizadores_id')->references('id')->on('autorizadores');
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
        Schema::dropIfExists('notas_credito');
    }
}
