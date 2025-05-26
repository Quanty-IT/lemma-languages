<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->json('availability')->change();
        });
    }

    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('availability')->change();
        });
    }
};
