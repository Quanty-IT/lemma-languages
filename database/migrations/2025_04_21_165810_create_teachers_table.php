<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('languages');
            $table->string('availability')->nullable();
            $table->decimal('hourly_rate', 8, 2);
            $table->decimal('commission', 5, 2);
            $table->string('pix')->unique();
            $table->text('notes')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};