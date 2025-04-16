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
    Schema::create('teachers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone');
        $table->string('email');
        $table->string('availability');
        $table->float('hourly_rate');
        $table->float('commission');
        $table->string('pix');
        $table->string('notes');
    });
}

public function down()
{
    Schema::dropIfExists('teachers');
}

};
