<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overall_leaderboards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->onDelete('cascade');
            $table->integer('total_points');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overall_leaderboards');
    }
};
