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
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('campaign_id')->constrained();
            $table->foreignUuid('collaborator_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('MXN');
            $table->string('status')->default('pending'); // pending | paid | failed | refunded
            $table->string('payment_method')->nullable(); // card | tap_to_pay | spei
            $table->string('stripe_payment_intent_id')->unique()->nullable();
            $table->string('donor_name')->nullable();
            $table->string('donor_email')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->index(['collaborator_id', 'status']);
            $table->index(['campaign_id', 'paid_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
