<?php

use App\Models\Booking;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->uuid('uid')->nullable()->unique()->after('id');
            // Short opaque token for SMS pay links (e.g. /p/AB12CD34).
            $table->string('pay_token', 12)->nullable()->unique()->after('uid');
        });

        // Backfill any existing rows.
        Booking::whereNull('uid')->get()->each(function (Booking $b) {
            $b->forceFill([
                'uid' => (string) Str::uuid(),
                'pay_token' => strtoupper(Str::random(8)),
            ])->saveQuietly();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['uid', 'pay_token']);
        });
    }
};
