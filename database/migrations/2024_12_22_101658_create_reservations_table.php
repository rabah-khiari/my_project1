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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('id_reservation');
            $table->foreignId('id_seat')->constrained('seats')->onDelete('cascade'); // Links to seats table
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Links to users table
            $table->dateTime('reservation_date')->default(now()); // Automatically set reservation date
            $table->string('status'); // Reservation status
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
