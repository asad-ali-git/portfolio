<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Return all projects ordered by sort_order / latest.
     */
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::ordered()->get();

        return ProjectResource::collection($projects);
    }

    /**
     * Return only featured projects.
     */
    public function featured(): AnonymousResourceCollection
    {
        $projects = Project::featured()->ordered()->get();

        return ProjectResource::collection($projects);
    }

    /**
     * Store a new project.
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project = Project::create($data);

        return response()->json([
            'message' => 'Project created successfully.',
            'data'    => new ProjectResource($project),
        ], 201);
    }

    /**
     * Return a single project.
     */
    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project);
    }

    /**
     * Update an existing project.
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Remove old image
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return response()->json([
            'message' => 'Project updated successfully.',
            'data'    => new ProjectResource($project->fresh()),
        ]);
    }

    /**
     * Delete a project.
     */
    public function destroy(Project $project): JsonResponse
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted successfully.']);
    }
}
