<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::all();
        return response()->json([
            'customer' => $data
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
        $validate = $request->validated();
        Customer::create($validate);

        return response()->json('success', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $customerExist = Customer::find($customer);
        if (!$customerExist)
            return response()->json('false', 404);

        return response()->json($customerExist);


    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        $customer->update($validated);

        return response()->json('true', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json('true', 200);
    }
}
