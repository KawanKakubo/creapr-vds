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
        Schema::create('diagnostic_questions', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['estimulo', 'educacao', 'estruturas']);
            $table->text('question');
            $table->enum('type', ['yes_no', 'yes_no_evidence', 'checkbox', 'multiple_input', 'text']);
            $table->json('options')->nullable(); // Para checkboxes e multiple inputs
            $table->boolean('requires_evidence')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_questions');
    }
};
