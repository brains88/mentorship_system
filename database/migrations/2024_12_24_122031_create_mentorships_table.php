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
        Schema::create('mentorships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('mentee_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'active', 'completed'])->default('pending');
            $table->string('matched_interest'); // Track which interest caused the match
            
            // Add appointment fields
            $table->date('appointment_date')->nullable();
            $table->time('appointment_time')->nullable();
            $table->time('end_time')->nullable();
            
            $table->timestamps();
            
            $table->unique(['mentor_id', 'mentee_id', 'matched_interest']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentorships');
    }
};
