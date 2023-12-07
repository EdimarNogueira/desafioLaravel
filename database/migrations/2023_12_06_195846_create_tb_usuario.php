<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50); // Campo nome com tamanho 50
            $table->string('email', 120)->unique(); // Campo email com tamanho 120 e único
            $table->string('senha', 20); // Campo senha com tamanho 20
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_usuario');
    }
};

