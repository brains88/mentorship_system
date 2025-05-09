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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->json('interests')->nullable(); // Changed from area_of_interest
            $table->string('image')->nullable();
            $table->enum('role', ['admin', 'mentor', 'mentee']);
            $table->rememberToken();
            $table->timestamps();
            
            // Virtual column and its index
            $table->string('interests_first')->virtualAs('JSON_UNQUOTE(JSON_EXTRACT(interests, "$[0]"))');
            $table->index('interests_first', 'users_interests_index');
            
            // Add these new indexes
            $table->index(['role']); // Index for role column
            $table->index(['interests'], 'interests_index', 'BTREE'); // For MySQL 5.7+
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
