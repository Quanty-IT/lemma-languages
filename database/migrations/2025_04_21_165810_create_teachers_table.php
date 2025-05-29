<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->json('languages');
            $table->json('availability');
            $table->decimal('hourly_rate', 8, 2);
            $table->decimal('commission', 5, 2);
            $table->string('pix')->unique();
            $table->text('notes')->nullable();
            $table->boolean('is_first_access')->default(true);
            $table->string('password');
            $table->string('reset_code')->nullable();
            $table->timestamp('reset_code_expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
