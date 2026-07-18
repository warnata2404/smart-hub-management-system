<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BorrowingSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'equipment_id',
        'borrow_date',
        'return_date',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'borrow_date' => 'date',
            'return_date' => 'date',
        ];
    }

    /**
     * Get the equipment associated with this borrowing schedule.
     */
    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    /**
     * Get all bookings for this borrowing schedule.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
