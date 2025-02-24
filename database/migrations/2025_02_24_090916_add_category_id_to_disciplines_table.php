<?php

use Database\Seeders\DisciplineSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        // Step 1: Delete all disciplines and results (to avoid constraint issues)
        DB::table('disciplines')->delete();

        Schema::table('disciplines', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Category::class)->constrained()->cascadeOnDelete();
        });

        (new DisciplineSeeder)->run();
    }

    public function down(): void
    {
        Schema::table('disciplines', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
