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
            $table->unsignedBigInteger('requested_by'); // Wer hat ihn angefragt?
            $table->unsignedBigInteger('executed_by'); // Wer hat ihn ausgeführt?
            $table->unsignedBigInteger('target_user')->nullable(); // Optional: Wer wurde getroffen?
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            // set references
            $table->foreign('requested_by')->references('id')->on('users')->cascadeOnUpdate()->onDelete('cascade');
            $table->foreign('executed_by')->references('id')->on('users')->cascadeOnUpdate()->onDelete('cascade');
            $table->foreign('target_user')->references('id')->on('users')->cascadeOnUpdate()->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gamechanger_actions');
    }
};
