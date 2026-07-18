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
        Schema::create('borrowing_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('equipment_id')
                ->constrained('equipments')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('borrow_date');

            $table->date('return_date');

            $table->enum('status', [
                'available',
                'reserved',
                'completed',
                'cancelled',
            ])->default('available');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('borrow_date');
            $table->index('return_date');
            $table->index('status');
            $table->index(['equipment_id', 'borrow_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_schedules');
    }
};
