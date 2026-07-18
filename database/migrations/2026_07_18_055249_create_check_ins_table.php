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
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('booking_item_id')
                ->unique()
                ->constrained('booking_items')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('checked_in_by')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedInteger('returned_quantity');

            $table->enum('condition', [
                'good',
                'damaged',
                'maintenance',
            ])->default('good');

            $table->dateTime('checked_in_at');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('booking_id');
            $table->index('checked_in_by');
            $table->index('checked_in_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_ins');
    }
};
