<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transacoes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('usuario_id');
        $table->enum('tipo', ['receita', 'despesa']);
        $table->string('categoria', 50);
        $table->decimal('valor', 10, 2);
        $table->date('data');
        $table->string('forma_pagamento', 50)->nullable();
        $table->boolean('recorrente')->default(false);
        $table->timestamps();

        $table->foreign('usuario_id')->references('id')->on('cadastro')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
