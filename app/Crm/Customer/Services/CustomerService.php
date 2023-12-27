<?php

namespace Crm\Customer\Services;

use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerService
{

    public function index(Request $request): Collection
    {
        return Customer::all();
    }

    public function show(int $customerId)
    {
        //$customer = Customer::find($id);

        return Customer::find($customerId) ;
    }
    public function  create(string $name) : Customer
    {

        $customer = new Customer();
        $customer->name = $name;
        $customer->save();

        event(new CustomerCreation($customer));

        return $customer;
    }

    public function  update(Request $request, int $id)
    {
        $customer = User::find($id);
        if (! $customer)
        {
            return response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }
        $customer->name = $request->get('name');
        $customer->save();

        return $customer;
    }

    public function  delete(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $customer = User::find($id);
        if (! $customer)
        {
            return response()->json(['status' => 'Not Found'], ResponseAlias::HTTP_NOT_FOUND);
        }
        $customer->delete();
        return response()->json(['status' => 'deleted'], ResponseAlias::HTTP_OK);
    }
}
