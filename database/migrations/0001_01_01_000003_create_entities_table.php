<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Guru
        Schema::create('teachers', function (Blueprint $table){
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('alias');
            $table->enum('gender', ['male', 'female']);
            $table->string('teaching')->nullable();
            $table->string('email')->unique()->nullable();
            $table->unsignedBigInteger('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        // Tabel Kelas
        Schema::create('rooms', function (Blueprint $table){
            $table->id();
            $table->foreignId('teacher_id')->constrained()->unique()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('code')->unique();
            $table->string('name');
            $table->timestamps();
        });

        // Tabel Siswa
        Schema::create('students', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('code')->unique();
            $table->foreignId('room_id')->constrained()->index()->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->json('birth');
            $table->json('parents');
            $table->string('address')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('students');
    }
};