<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return Customer::all();
    }

    public function show($id)
    {
        //$customer = Customer::find($id);

        return Customer::find($id) ?? response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);;
    }
    public function  create(Request $request)
    {

        $customer = new Customer();
        $customer->name = $request->get('name');
        $customer->save();
        return $request->get('name');
        return $customer;
    }

    public function  update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (! $customer)
        {
            return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }
        $customer->name = $request->get('name');
        $customer->save();

        return $customer;
    }

    public function  delete(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (! $customer)
        {
            return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }
        $customer->delete();
        return response()->json(['status' => 'deleted'], Response::HTTP_OK);
    }
}
