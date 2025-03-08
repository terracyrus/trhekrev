<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gamechangers', function (Blueprint $table) {
            $table->integer('max_executions')->default(1); // Default: 1 execution per request
        });
    }

    public function down(): void
    {
        Schema::table('gamechangers', function (Blueprint $table) {
            $table->dropColumn('max_executions');
        });
    }
};
