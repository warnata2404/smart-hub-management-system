<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'booking_code',
        'user_id',
        'borrowing_schedule_id',
        'booking_date',
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
            'booking_date' => 'date',
            'return_date' => 'date',
        ];
    }

    /**
     * Get the user who created the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the borrowing schedule associated with this booking.
     */
    public function borrowingSchedule(): BelongsTo
    {
        return $this->belongsTo(BorrowingSchedule::class);
    }

    /**
     * Get all booking items.
     */
    public function bookingItems(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }

    /**
     * Get the check-in record for this booking.
     */
    public function checkIn(): HasOne
    {
        return $this->hasOne(CheckIn::class);
    }
}
