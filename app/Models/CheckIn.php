<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckIn extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'booking_id',
        'booking_item_id',
        'checked_in_by',
        'returned_quantity',
        'condition',
        'checked_in_at',
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
            'returned_quantity' => 'integer',
            'checked_in_at' => 'datetime',
        ];
    }

    /**
     * Get the booking associated with this check-in.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the booking item associated with this check-in.
     */
    public function bookingItem(): BelongsTo
    {
        return $this->belongsTo(BookingItem::class);
    }

    /**
     * Get the user who performed the check-in.
     */
    public function checkedInBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }
}
