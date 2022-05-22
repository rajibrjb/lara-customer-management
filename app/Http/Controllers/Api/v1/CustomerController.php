<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\BaseController;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Exception;
use Illuminate\Http\Request;
use Validator;

class CustomerController extends BaseController
{

    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $fields = [
                'first_name',
                'last_name',
                'full_name',
                'gender',
                'street',
                'city',
                'email',
                ];
                $customers = $this->customerService->getAll([],request()->all());
            return parent::sendResponse(CustomerResource::collection($customers,$fields), "Customer List");
        } catch (Exception $e) {
            return parent::sendError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $fields = [
                'first_name',
                'last_name',
                'full_name',
                'gender',
                'street',
                'city',
                'email',
                ];

            $customer = Customer::create(request()->all());

            return parent::sendResponse(new CustomerResource($customer, $fields), "Customer has been created successfully");
        } catch (Exception $e) {
            return parent::sendError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        try {
            $fields = [
                'first_name',
                'last_name',
                'full_name',
                'gender',
                'street',
                'city',
                'email',
                ];

            return parent::sendResponse(new CustomerResource($customer,$fields));
        } catch (Exception $e) {
            return parent::sendError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $rules = [];

            $validator = Validator::make(request()->all(), $rules);

            if ($validator->fails()) {
                // Validation error..
                return parent::sendError($validator->getMessageBag()->toArray(), "", 400);
            }

            $fields = [
                'first_name',
                'last_name',
                'full_name',
                'gender',
                'street',
                'city',
                'email',
                ];

            $customer->update(request()->all());

            return parent::sendResponse(new CustomerResource($customer, $fields), "Customer has been updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return parent::sendResponse(null, "Customer has been deleted successfully");
    }
}
