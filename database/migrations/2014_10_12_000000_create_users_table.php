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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birthdate');
            $table->string('no_induk')->unique();
            $table->string('no_hp')->unique()->nullable();
            $table->text('address')->nullable();
            $table->enum('major', ['mi', 'ai', 'tppm', 'kesehatan', 'kepegawaian']);
            $table->enum('role', ['admin', 'dosen', 'mahasiswa', 'staff']);
            $table->string('avatar')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('isRegistered')->default(0);
            $table->boolean('isMicrosoftAccount')->default(0);
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
