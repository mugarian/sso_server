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
        Schema::create('tema_portals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->string('cover_main')->nullable();
            $table->string('bg_main')->default('#4e73df');
            $table->string('layout_main')->default('#ffffff');
            $table->string('color_main')->default('#3a3b45');
            $table->string('button_primary')->default('#4E73DF');
            $table->string('button_color_primary')->default('#ffffff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tema_portals');
    }
};
