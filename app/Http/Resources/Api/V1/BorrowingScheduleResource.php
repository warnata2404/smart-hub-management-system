<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingScheduleResource extends JsonResource
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

            'equipment_id' => $this->equipment_id,

            'borrow_date' => $this->borrow_date,
            'return_date' => $this->return_date,

            'status' => $this->status,
            'notes' => $this->notes,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'equipment' => new EquipmentResource(
                $this->whenLoaded('equipment')
            ),

            'bookings' => BookingResource::collection(
                $this->whenLoaded('bookings')
            ),
        ];
    }
}
