<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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

            'booking_code' => $this->booking_code,

            'user_id' => $this->user_id,

            'borrowing_schedule_id' => $this->borrowing_schedule_id,

            'booking_date' => $this->booking_date,
            'return_date' => $this->return_date,

            'status' => $this->status,
            'notes' => $this->notes,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user' => new UserResource(
                $this->whenLoaded('user')
            ),

            'borrowing_schedule' => new BorrowingScheduleResource(
                $this->whenLoaded('borrowingSchedule')
            ),

            'booking_items' => BookingItemResource::collection(
                $this->whenLoaded('bookingItems')
            ),

            'check_in' => new CheckInResource(
                $this->whenLoaded('checkIn')
            ),
        ];
    }
}
