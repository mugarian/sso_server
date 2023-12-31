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
        Schema::create('celebrates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('receiver_id')->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('sender_id')->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->text('message');
            $table->text('reply')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celebrates');
    }
};
