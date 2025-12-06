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
        Schema::create('properties', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable(); // e.g. "Flat 2 - Mr Smith"
        $table->string('reference')->nullable(); // optional internal ref
        $table->string('address_line1');
        $table->string('address_line2')->nullable();
        $table->string('city')->nullable();
        $table->string('postcode')->nullable();
        $table->decimal('lat', 10, 7)->nullable();
        $table->decimal('lng', 10, 7)->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
