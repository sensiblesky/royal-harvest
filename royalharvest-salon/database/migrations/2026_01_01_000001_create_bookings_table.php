<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code');
            $table->string('fullname');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('date');
            $table->string('time');
            $table->string('service')->default('Salon Visit');
            $table->text('notes')->nullable();
            $table->boolean('isDone')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
