<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Deposit / payment tracking
            $table->unsignedBigInteger('service_amount')->nullable()->after('service'); // full service price snapshot (TZS)
            $table->unsignedBigInteger('deposit_amount')->nullable()->after('service_amount'); // 10% deposit (TZS)
            // payment_status: unpaid | pending | paid | failed | not_required
            $table->string('payment_status')->default('unpaid')->after('deposit_amount');
            $table->string('payment_method')->nullable()->after('payment_status'); // mobile | card
            $table->string('payment_reference')->nullable()->index()->after('payment_method'); // Snippe reference
            $table->timestamp('paid_at')->nullable()->after('payment_reference');
            $table->boolean('sms_sent')->default(false)->after('paid_at');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'service_amount', 'deposit_amount', 'payment_status',
                'payment_method', 'payment_reference', 'paid_at', 'sms_sent',
            ]);
        });
    }
};
