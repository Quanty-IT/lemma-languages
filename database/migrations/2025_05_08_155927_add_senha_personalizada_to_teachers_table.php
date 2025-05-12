<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Adiciona a coluna 'senha_personalizada' para armazenar a senha personalizada
            $table->string('custom_password')->nullable(); 
        });
    }

    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Remove a coluna 'senha_personalizada' caso seja necessário desfazer a migration
            $table->dropColumn('custom_password');
        });
    }
};
