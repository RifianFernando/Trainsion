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
        Schema::create('booking_tickets', function (Blueprint $table) {
            // https: //laravel.com/docs/10.x/migrations#creating-columns
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->enum('class', ['Economy', 'Executive']);
            $table->foreignId('user_booking_ticket_id')->constrained('user_booking_tickets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_tickets');
    }
};
