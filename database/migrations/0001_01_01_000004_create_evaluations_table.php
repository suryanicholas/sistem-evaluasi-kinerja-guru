<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('evaluations', function (Blueprint $table){
            $table->id();
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->json('periode')->nullable();
            $table->timestamps();
        });
        Schema::create('segments', function (Blueprint $table){
            $table->id();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('index');
            $table->string('label')->nullable();

            $table->timestamps();
        });
        Schema::create('questions', function (Blueprint $table){
            $table->id();
            $table->foreignId('segment_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('index');
            $table->string('question')->nullable();
            
            $table->timestamps();
        });

        Schema::create('responses', function (Blueprint $table){
            $table->id();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->json('respondent');
            $table->json('answers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
        Schema::dropIfExists('segments');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('responses');
    }
};