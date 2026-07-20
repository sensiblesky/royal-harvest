<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Exact price in TZS (whole shillings). Null => "Custom quote" (no deposit, enquiry only).
            $table->unsignedBigInteger('price_amount')->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('price_amount');
        });
    }
};
