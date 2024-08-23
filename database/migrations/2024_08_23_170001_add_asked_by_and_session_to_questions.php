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
        Schema::table('questions', function (Blueprint $table) {
            $table->string('asked_by');
            $table->unsignedBigInteger('session_code_id');
            $table->foreign('session_code_id')->references('id')->on('session_codes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['session_code_id']);
            $table->dropColumn(['asked_by', 'session_code_id']);
        });
    }
};
