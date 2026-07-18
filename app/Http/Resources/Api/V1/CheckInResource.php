<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckInResource extends JsonResource
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
            'booking_item_id' => $this->booking_item_id,
            'checked_in_by' => $this->checked_in_by,

            'returned_quantity' => $this->returned_quantity,
            'condition' => $this->condition,

            'checked_in_at' => $this->checked_in_at,

            'notes' => $this->notes,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'booking' => new BookingResource(
                $this->whenLoaded('booking')
            ),

            'booking_item' => new BookingItemResource(
                $this->whenLoaded('bookingItem')
            ),

            'checked_in_user' => new UserResource(
                $this->whenLoaded('checkedInBy')
            ),
        ];
    }
}
