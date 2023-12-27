<?php

namespace App\Http\Controllers;

use Crm\Customer\Models\Customer;
use Crm\Customer\Models\User;
use Crm\Customer\Requests\CreateCustomer;
use Crm\Customer\Services\CustomerService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request): Collection
    {
        return $this->customerService->index($request);
    }

    public function show($customerId)
    {
        return $this->customerService->show($customerId) ??  response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
    }
    public function  create(CreateCustomer $request): Customer
    {

        return $this->customerService->create($request->get('name'));
    }

    public function  update(Request $request, int $id)
    {
        return $this->customerService->update($request, $id);
    }

    public function  delete(Request $request, int $id)
    {
        return $this->customerService->delete($request, $id);
    }
}
