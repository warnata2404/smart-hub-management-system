<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'quantity',
        'available_quantity',
        'condition',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'available_quantity' => 'integer',
        ];
    }

    /**
     * Get all booking items that use this equipment.
     */
    public function bookingItems(): HasMany
    {
        return $this->hasMany(BookingItem::class);
    }

    /**
     * Get all borrowing schedules for this equipment.
     */
    public function borrowingSchedules(): HasMany
    {
        return $this->hasMany(BorrowingSchedule::class);
    }
}
