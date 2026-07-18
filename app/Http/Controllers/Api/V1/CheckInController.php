<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckInRequest;
use App\Http\Requests\UpdateCheckInRequest;
use App\Http\Resources\Api\V1\CheckInResource;
use App\Models\CheckIn;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $checkIns = CheckIn::query()
            ->latest()
            ->paginate(10);

        return CheckInResource::collection($checkIns);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCheckInRequest $request): JsonResponse
    {
        $checkIn = CheckIn::create(
            $request->validated()
        );

        return (new CheckInResource($checkIn))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CheckIn $checkIn): CheckInResource
    {
        return new CheckInResource($checkIn);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateCheckInRequest $request,
        CheckIn $checkIn
    ): CheckInResource {
        $checkIn->update(
            $request->validated()
        );

        $checkIn->refresh();

        return new CheckInResource($checkIn);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CheckIn $checkIn): JsonResponse
    {
        $checkIn->delete();

        return response()->json(
            [
                'message' => 'Check-in deleted successfully.',
            ],
            200
        );
    }
}
