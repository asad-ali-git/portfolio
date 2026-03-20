<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SkillController extends Controller
{
    /**
     * Return all skills grouped by category.
     */
    public function index(): JsonResponse
    {
        $skills = Skill::ordered()->get();

        $grouped = $skills->groupBy('category')->map(function ($items) {
            return SkillResource::collection($items);
        });

        return response()->json(['data' => $grouped]);
    }

    /**
     * Store a new skill.
     */
    public function store(StoreSkillRequest $request): JsonResponse
    {
        $skill = Skill::create($request->validated());

        return response()->json([
            'message' => 'Skill created successfully.',
            'data'    => new SkillResource($skill),
        ], 201);
    }

    /**
     * Return a single skill.
     */
    public function show(Skill $skill): SkillResource
    {
        return new SkillResource($skill);
    }

    /**
     * Update an existing skill.
     */
    public function update(UpdateSkillRequest $request, Skill $skill): JsonResponse
    {
        $skill->update($request->validated());

        return response()->json([
            'message' => 'Skill updated successfully.',
            'data'    => new SkillResource($skill->fresh()),
        ]);
    }

    /**
     * Delete a skill.
     */
    public function destroy(Skill $skill): JsonResponse
    {
        $skill->delete();

        return response()->json(['message' => 'Skill deleted successfully.']);
    }
}
