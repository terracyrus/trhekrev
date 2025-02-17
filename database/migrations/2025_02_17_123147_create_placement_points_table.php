<?php

use Database\Seeders\PlacementPointsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('placement_points', function (Blueprint $table) {
            $table->id();
            $table->integer('placement_start');
            $table->integer('placement_end');
            $table->integer('points');
            $table->timestamps();
        });

        (new PlacementPointsSeeder)->run();

    }

    public function down(): void
    {
        Schema::dropIfExists('placement_points');
    }
};
