<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,

            'quantity' => $this->quantity,
            'available_quantity' => $this->available_quantity,

            'condition' => $this->condition,
            'status' => $this->status,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'booking_items' => BookingItemResource::collection(
                $this->whenLoaded('bookingItems')
            ),

            'borrowing_schedules' => BorrowingScheduleResource::collection(
                $this->whenLoaded('borrowingSchedules')
            ),
        ];
    }
}
