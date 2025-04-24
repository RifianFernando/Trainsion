<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_path');
            $table->string('description');
            $table->string('departure_time');
            $table->foreignId('origin_train_station_id')
                ->constrained(
                    table: 'train_stations',
                    indexName: 'origin_train_station_id_foreign'
                );
            $table->foreignId('destination_train_station_id')
                ->constrained(
                    table: 'train_stations',
                    indexName: 'destination_train_station_id_foreign'
                );
            $table->decimal('economy_price',9,3);
            $table->decimal('executive_price',9,3);
            $table->string('seats_available');
            $table->timestamps();

            // make sure that the origin and destination are not the same
            $table->unique(['origin_train_station_id', 'destination_train_station_id'], 'unique_origin_destination');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trains');
    }
};
