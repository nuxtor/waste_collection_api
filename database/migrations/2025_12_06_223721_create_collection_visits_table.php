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
       Schema::create('collection_visits', function (Blueprint $table) {
        $table->id();
        $table->foreignId('collection_job_id')->constrained()->cascadeOnDelete();
        $table->enum('status', ['completed', 'missed'])->default('completed');
        $table->timestamp('completed_at')->nullable();
        $table->decimal('lat', 10, 7)->nullable();
        $table->decimal('lng', 10, 7)->nullable();
        $table->decimal('accuracy', 8, 2)->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_visits');
    }
};
