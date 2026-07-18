<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingItemRequest;
use App\Http\Requests\UpdateBookingItemRequest;
use App\Http\Resources\Api\V1\BookingItemResource;
use App\Models\BookingItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $bookingItems = BookingItem::query()
            ->latest()
            ->paginate(10);

        return BookingItemResource::collection($bookingItems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingItemRequest $request): JsonResponse
    {
        $bookingItem = BookingItem::create(
            $request->validated()
        );

        return (new BookingItemResource($bookingItem))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingItem $bookingItem): BookingItemResource
    {
        return new BookingItemResource($bookingItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateBookingItemRequest $request,
        BookingItem $bookingItem
    ): BookingItemResource {
        $bookingItem->update(
            $request->validated()
        );

        $bookingItem->refresh();

        return new BookingItemResource($bookingItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingItem $bookingItem): JsonResponse
    {
        $bookingItem->delete();

        return response()->json(
            [
                'message' => 'Booking item deleted successfully.',
            ],
            200
        );
    }
}
