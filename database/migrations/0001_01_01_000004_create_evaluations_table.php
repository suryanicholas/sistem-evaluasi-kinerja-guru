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
            $table->string('token')->unique();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('type', ['teacher', 'student'])->default('student');
            $table->unsignedBigInteger('respondent');
            $table->boolean('already_sent')->default(false);
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table){
            $table->id();
            $table->foreignId('response_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('segment_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('answer')->index()->nullable();
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
        Schema::dropIfExists('answers');
    }
};