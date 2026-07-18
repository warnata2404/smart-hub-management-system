<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowingScheduleRequest;
use App\Http\Requests\UpdateBorrowingScheduleRequest;
use App\Http\Resources\Api\V1\BorrowingScheduleResource;
use App\Models\BorrowingSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BorrowingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $borrowingSchedules = BorrowingSchedule::query()
            ->latest()
            ->paginate(10);

        return BorrowingScheduleResource::collection($borrowingSchedules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowingScheduleRequest $request): JsonResponse
    {
        $borrowingSchedule = BorrowingSchedule::create(
            $request->validated()
        );

        return (new BorrowingScheduleResource($borrowingSchedule))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowingSchedule $borrowingSchedule): BorrowingScheduleResource
    {
        return new BorrowingScheduleResource($borrowingSchedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateBorrowingScheduleRequest $request,
        BorrowingSchedule $borrowingSchedule
    ): BorrowingScheduleResource {
        $borrowingSchedule->update(
            $request->validated()
        );

        $borrowingSchedule->refresh();

        return new BorrowingScheduleResource($borrowingSchedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowingSchedule $borrowingSchedule): JsonResponse
    {
        $borrowingSchedule->delete();

        return response()->json(
            [
                'message' => 'Borrowing schedule deleted successfully.',
            ],
            200
        );
    }
}
