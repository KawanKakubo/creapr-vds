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
        Schema::create('diagnostic_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('diagnostic_question_id')->constrained()->cascadeOnDelete();
            $table->enum('category', ['estimulo', 'educacao', 'estruturas']);
            $table->boolean('answer_yes_no')->nullable();
            $table->json('answer_checkboxes')->nullable();
            $table->json('answer_multiple_input')->nullable();
            $table->text('answer_text')->nullable();
            $table->string('evidence_url')->nullable();
            $table->decimal('points_earned', 8, 2)->default(0);
            $table->timestamps();
            
            $table->unique(['submission_id', 'diagnostic_question_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_answers');
    }
};
