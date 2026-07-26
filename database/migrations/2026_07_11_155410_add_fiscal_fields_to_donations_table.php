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
            $table->boolean('wants_invoice')->default(false)->after('donor_rfc');
            $table->enum('person_type', ['fisica', 'moral'])->nullable()->after('wants_invoice');
            $table->string('razon_social')->nullable()->after('person_type');
            $table->string('fiscal_email')->nullable()->after('razon_social');
            $table->string('uso_cfdi')->nullable()->after('fiscal_email');
            $table->string('regimen_fiscal')->nullable()->after('uso_cfdi');
            $table->string('codigo_postal', 10)->nullable()->after('regimen_fiscal');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn([
                'wants_invoice', 'person_type', 'razon_social',
                'fiscal_email', 'uso_cfdi', 'regimen_fiscal', 'codigo_postal'
            ]);
        });
    }
};
