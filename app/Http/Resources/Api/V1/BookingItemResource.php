<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingItemResource extends JsonResource
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

            'booking_id' => $this->booking_id,
            'equipment_id' => $this->equipment_id,

            'quantity' => $this->quantity,
            'returned_quantity' => $this->returned_quantity,

            'notes' => $this->notes,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'booking' => new BookingResource(
                $this->whenLoaded('booking')
            ),

            'equipment' => new EquipmentResource(
                $this->whenLoaded('equipment')
            ),

            'check_in' => new CheckInResource(
                $this->whenLoaded('checkIn')
            ),
        ];
    }
}
