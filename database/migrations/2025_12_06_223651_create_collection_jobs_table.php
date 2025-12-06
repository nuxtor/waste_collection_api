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
         Schema::create('collection_jobs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('property_id')->constrained()->cascadeOnDelete();
        $table->foreignId('driver_id')->constrained('users')->cascadeOnDelete();
        $table->date('scheduled_date');
        $table->enum('status', ['pending', 'in_progress', 'completed', 'missed'])
              ->default('pending');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_jobs');
    }
};
