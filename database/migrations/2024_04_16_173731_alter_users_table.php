<?php

use App\Service\Schema\Blueprint;
use App\Service\Schema\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        echo "\n";

        echo "stuff.stuff...\n";
        var_dump(\DB::statement("
            ALTER TABLE stuff
            MODIFY stuff BIGINT UNSIGNED NULL
        "));

        \Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'fullname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('fullname', 'name');
        });
    }
};
