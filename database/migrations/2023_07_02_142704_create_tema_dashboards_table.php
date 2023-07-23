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
        Schema::create('tema_dashboards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('bg_sidebar')->default('#4e73df');
            $table->string('color_sidebar')->default('#ffffff');
            $table->string('bg_sidebar_active')->default('black');

            $table->string('bg_navbar')->default('#ffffff');
            $table->string('color_navbar')->default('#858796');

            $table->string('bg_footer')->default('#f8f8f8');
            $table->string('color_footer')->default('#858796');

            $table->string('bg_content')->default('#f8f8f8');
            $table->string('color_content')->default('#5a5c69');

            $table->string('bg_primary')->default('#4e73df');
            $table->string('color_primary')->default('#ffffff');

            $table->string('bg_secondary')->default('#858796');
            $table->string('color_secondary')->default('#ffffff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tema_dashboards');
    }
};
