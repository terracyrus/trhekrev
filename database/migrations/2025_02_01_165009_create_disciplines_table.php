<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('type', 6)->default('points'); // points, time
            $table->tinyInteger('order')->default(1); // 0 = down, 1 = up
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disciplines');
    }
};
