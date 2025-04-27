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
            $table->string('train_image');
            $table->string('description');
            $table->dateTime('departure_time');
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
            // https://laracasts.com/discuss/channels/laravel/best-data-type-is-for-storing-money-values
            $table->integer('economy_price');
            $table->integer('executive_price');
            $table->string('seats_available');
            $table->timestamps();
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
