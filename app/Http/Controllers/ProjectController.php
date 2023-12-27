<?php

namespace App\Http\Controllers;

use Crm\Customer\Services\CustomerService;
use Crm\Project\Requests\CreateProject;
use Crm\Project\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class ProjectController extends Controller
{
    private readonly ProjectService $projectService;
    private CustomerService $customerService;
    public function __construct(ProjectService $projectService, CustomerService $customerService)
    {
        $this->projectService = $projectService;
        $this->customerService = $customerService;
    }
    public function index(Request $request)
    {
        return $this->projectService->index($request) ;
    }

    public function show($customerId, $projectId)
    {
        return $this->projectService->show($customerId, $projectId);
    }
    public function  create(CreateProject $request, int $customerId)
    {
        $customer = $this->customerService->show($customerId);
        if (! $customer ){
            return response()->json(['status' => 'Customer Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }
        return $this->projectService->create($request, $customerId);
    }

    public function  update(Request $request, int $customerId, int $projectId)
    {
        return $this->projectService->update($request, $customerId, $projectId);
    }

    /**
     * @return JsonResponse
     */
    public function  delete(int $customerId, int $projectId): \Illuminate\Http\JsonResponse
    {
        return $this->projectService->delete($customerId, $projectId);
    }
}
