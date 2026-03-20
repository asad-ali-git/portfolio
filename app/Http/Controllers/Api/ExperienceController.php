<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExperienceController extends Controller
{
    /**
     * Return all experiences ordered by start_date descending.
     */
    public function index(): AnonymousResourceCollection
    {
        $experiences = Experience::ordered()->get();

        return ExperienceResource::collection($experiences);
    }

    /**
     * Store a new experience entry.
     */
    public function store(StoreExperienceRequest $request): JsonResponse
    {
        $experience = Experience::create($request->validated());

        return response()->json([
            'message' => 'Experience created successfully.',
            'data'    => new ExperienceResource($experience),
        ], 201);
    }

    /**
     * Return a single experience.
     */
    public function show(Experience $experience): ExperienceResource
    {
        return new ExperienceResource($experience);
    }

    /**
     * Update an existing experience.
     */
    public function update(UpdateExperienceRequest $request, Experience $experience): JsonResponse
    {
        $experience->update($request->validated());

        return response()->json([
            'message' => 'Experience updated successfully.',
            'data'    => new ExperienceResource($experience->fresh()),
        ]);
    }

    /**
     * Delete an experience.
     */
    public function destroy(Experience $experience): JsonResponse
    {
        $experience->delete();

        return response()->json(['message' => 'Experience deleted successfully.']);
    }
}
