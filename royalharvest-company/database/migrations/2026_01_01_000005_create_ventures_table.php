<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();      // e.g. Beauty, Education, Retail
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();            // external site link (optional)
            $table->string('status')->default('live');    // live | coming_soon
            $table->boolean('isActive')->default(true);
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventures');
    }
};
