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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'municipality'])->default('municipality')->after('email');
            $table->boolean('is_temporary_password')->default(false)->after('password');
            $table->boolean('must_change_password')->default(false)->after('is_temporary_password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_temporary_password', 'must_change_password']);
        });
    }
};
