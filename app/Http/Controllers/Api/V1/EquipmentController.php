<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\Api\V1\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $search = request('search');

        $equipments = Equipment::query()
            ->when(
                $search,
                function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('code', 'like', "%{$search}%")
                            ->orWhere('name', 'like', "%{$search}%")
                            ->orWhere('condition', 'like', "%{$search}%")
                            ->orWhere('status', 'like', "%{$search}%");
                    });
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return EquipmentResource::collection($equipments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentRequest $request): JsonResponse
    {
        $equipment = Equipment::create(
            $request->validated()
        );

        return (new EquipmentResource($equipment))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment): EquipmentResource
    {
        return new EquipmentResource($equipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateEquipmentRequest $request,
        Equipment $equipment
    ): EquipmentResource {
        $equipment->update(
            $request->validated()
        );

        $equipment->refresh();

        return new EquipmentResource($equipment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment): JsonResponse
    {
        $equipment->delete();

        return response()->json(
            [
                'message' => 'Equipment deleted successfully.',
            ],
            200
        );
    }
}
