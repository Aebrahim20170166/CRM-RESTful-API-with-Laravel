<?php

namespace Crm\Project\Services;
use Crm\Project\Events\ProjectCreation;
use Crm\Project\Models\Project;
use Crm\Project\Requests\CreateProject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProjectService
{
    public function index(Request $request): Collection
    {
        return Project::all();
    }

    public function show($customerId, $projectId)
    {
        $project = Project::find($projectId);

        if (! $project)
        {
            return response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        if ( $project->customer_id !== (int) $customerId)
        {
            return response()->json(['status' => 'Invalid Data'], ResponseAlias::HTTP_BAD_REQUEST);
        }

        return $project;
    }
    public function  create(CreateProject $request, int $customerId) : Project
    {

        $project = new Project();
        $project->name = $request->get('name');
        $project->status = (bool) $request->get('status');
        $project->customer_id = $customerId;
        $project->project_cost = (float) $request->get('cost');

        $project->save();
        event(new ProjectCreation($project));

        return $project;
    }

    public function  update(Request $request, int $customerId, int $projectId)
    {
        $project = Project::find($projectId);
        if (! $project)
        {
            return response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }

        if ( $project -> customer_id !== $customerId){
            return response() -> json(['status' => 'Invalid Data'], Response::HTTP_BAD_REQUEST);
        }

        $project->name = $request->get('name');
        $project->status = (bool) $request->get('status');
        $project->customer_id = $customerId;
        $project->project_cost = $request->get('cost');

        $project->save();

        return $project;
    }

    public function  delete(int $customerId, int $projectId): \Illuminate\Http\JsonResponse
    {
        $project = Project::find($projectId);
        if (! $project)
        {
            return response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }
        if ( $project -> customer_id !== $customerId){
            return response() -> json(['status' => 'Invalid Data'], Response::HTTP_BAD_REQUEST);
        }
        $project->delete();
        return response()->json(['status' => 'deleted'], ResponseAlias::HTTP_OK);
    }
}
