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
        Schema::table('students', function (Blueprint $table) {
            $table->string('phone')->unique()->change();

            $table->json('availability')->nullable(false)->change();
            $table->json('languages')->nullable(false)->change();
            $table->text('goal')->nullable(false)->change();

            if (Schema::hasColumn('students', 'observation')) {
                $table->renameColumn('observation', 'notes');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique(['phone']);

            $table->json('availability')->nullable()->change();
            $table->json('languages')->nullable()->change();
            $table->text('goal')->nullable()->change();

            if (Schema::hasColumn('students', 'notes')) {
                $table->renameColumn('notes', 'observation');
            }
        });
    }
};
