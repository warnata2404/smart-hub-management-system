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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_code', 30)->unique();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('borrowing_schedule_id')
                ->constrained('borrowing_schedules')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('booking_date');

            $table->date('return_date');

            $table->enum('status', [
                'pending',
                'approved',
                'borrowed',
                'completed',
                'cancelled',
            ])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('booking_code');
            $table->index('booking_date');
            $table->index('return_date');
            $table->index('status');
            $table->index('user_id');
            $table->index('borrowing_schedule_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
