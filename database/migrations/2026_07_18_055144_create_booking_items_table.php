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
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('equipment_id')
                ->constrained('equipments')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedInteger('quantity');

            $table->unsignedInteger('returned_quantity')
                ->default(0);

            $table->text('notes')
                ->nullable();

            $table->timestamps();

            $table->index('booking_id');
            $table->index('equipment_id');
            $table->index(['booking_id', 'equipment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};
