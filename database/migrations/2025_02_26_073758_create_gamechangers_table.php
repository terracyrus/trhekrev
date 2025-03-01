<?php

use Database\Seeders\GamechangerSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gamechangers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name des Gamechangers
            $table->integer('min_disciplines'); // Mindestanzahl an Disziplinen für Aktivierung
            $table->integer('cost'); // Kosten in Punkten
            $table->text('effect'); // Beschreibung der Auswirkung
            $table->string('icon', 800)->nullable(); // SVG-Icon als String speichern
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        (new GamechangerSeeder)->run();
    }

    public function down(): void
    {
        Schema::dropIfExists('gamechangers');
    }
};
