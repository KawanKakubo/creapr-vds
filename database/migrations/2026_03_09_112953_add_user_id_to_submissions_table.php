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
        Schema::table('submissions', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected'])->default('pending')->after('declaracao_interesse');
            $table->text('status_observacao')->nullable()->after('status');
            $table->timestamp('aprovado_em')->nullable()->after('status_observacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'status', 'status_observacao', 'aprovado_em']);
        });
    }
};
