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
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['collaborator_id']);
            $table->foreignUuid('collaborator_id')
                ->nullable()
                ->change();
            $table->foreign('collaborator_id')
                ->references('id')
                ->on('collaborators')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['collaborator_id']);
            $table->foreignUuid('collaborator_id')
                ->nullable(false)
                ->change();
            $table->foreign('collaborator_id')
                ->references('id')
                ->on('collaborators');
        });
    }
};
