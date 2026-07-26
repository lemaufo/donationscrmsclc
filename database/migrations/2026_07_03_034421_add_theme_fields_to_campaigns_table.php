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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('theme_color')->default('#dc2626');
            $table->string('logo_url')->nullable();
            $table->string('banner_url')->nullable();
            $table->string('registration_token')->unique()->nullable();
            $table->text('welcome_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['theme_color', 'logo_url', 'banner_url', 'registration_token', 'welcome_message']);
        });
    }
};
