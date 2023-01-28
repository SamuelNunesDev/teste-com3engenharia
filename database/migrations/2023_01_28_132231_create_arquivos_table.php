<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('caminho');
            $table->unsignedBigInteger('criado_por');
            $table->timestamp('criado_em');
            $table->timestamp('atualizado_em');
            $table->softDeletes('excluido_em');

            $table->foreign('criado_por')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos');
    }
};
