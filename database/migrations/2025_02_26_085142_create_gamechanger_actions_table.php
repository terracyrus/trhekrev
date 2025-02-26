<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gamechanger_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Gamechanger::class)->constrained()->cascadeOnUpdate()->onDelete('cascade');
            $table->foreignId('requested_by')->constrained('user_id')->cascadeOnUpdate()->onDelete('cascade'); // Wer hat ihn angefragt?
            $table->foreignId('executed_by')->constrained('user_id')->cascadeOnUpdate()->onDelete('set null'); // Wer hat ihn ausgeführt?
            $table->foreignId('target_user')->nullable()->constrained('user_id')->cascadeOnUpdate()->onDelete('set null'); // Optional: Wer wurde getroffen?
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gamechanger_actions');
    }
};
