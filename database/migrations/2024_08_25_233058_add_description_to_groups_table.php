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
        Schema::table('groups', function (Blueprint $table) {
            $table->longText('description')->after('group')->nullable();
            $table->longText('solution')->after('group')->nullable();
            $table->string('link')->after('group')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('solution');
            $table->dropColumn('link');
        });
    }
};
