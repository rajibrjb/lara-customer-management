<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\BaseController;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Services\CustomerService;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
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
                $rules = [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'gender' => 'required',
                    // 'street' => 'required',
                    'city' => 'required',
                    'email' => 'required',



                    // 'abn' =>'required',
                    // 'tfn' =>'required',
                    // 'bsb' =>'required',
                    // 'account_no' =>'required',
                    // 'spouse_name' =>'required',
                    // 'spouse_date_of_birth' =>'required',
                    // 'no_of_dependants' =>'required',
                    // 'spouse_income' =>'required',
                    // 'have_log_book'=>'required',
                    // 'model' => 'required',
                    // 'rego' => 'required',
                    // 'kms' => 'required',
                    // 'work_related_travel_expense' =>'required',
                    // 'work_related_travel_expense_amount' => 'required',
                    // 'uniform' =>'required',
                    // 'shoes' => 'required',
                    // 'laundry' => 'required',
                    // 'work_related_self_education_expense' => 'required',
                    // 'work_related_self_education_expense_amount' =>'required',
                    // 'mobile_phone_business' =>'required',
                    // 'mobile_phone_amount' =>'required',
                    // 'internet_business' =>'required',
                    // 'internet_amount' =>'required',
                    // 'computer_expense_business' =>'required',
                    // 'computer_expense_amount' =>'required',
                    // 'seminar_printing_books_business' =>'required',
                    // 'seminar_printing_books_amount' =>'required',
                    // 'tools_business' =>'required',
                    // 'tools_amount' =>'required',
                    // 'license_business' =>'required',
                    // 'license_amount' =>'required',
                    // 'union_fees_business' =>'required',
                    // 'union_fees_amount' =>'required',
                    // 'overtime_business' =>'required',
                    // 'overtime_amount' =>'required',
                    // 'others' =>'required',
                    // 'others_business' => 'required',
                    // 'others_amount' =>'required'

                ];
                $validator = Validator::make(request()->all(), $rules);

                if ($validator->fails()) {
                    // Validation error..
                    return parent::sendError($validator->getMessageBag()->toArray(), "", 400);
                }
            $customer = $this->customerService->save(request()->all());

            return parent::sendResponse($customer, "Customer has been created successfully");
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
        }
        catch (Exception $e) {
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
        $rules = [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'gender' => 'required',
            // 'street' => 'required',
            // 'city' => 'required',
            // 'email' => 'required',


             // 'abn' =>'required',
                    // 'tfn' =>'required',
                    // 'bsb' =>'required',
                    // 'account_no' =>'required',
                    // 'spouse_name' =>'required',
                    // 'spouse_date_of_birth' =>'required',
                    // 'no_of_dependants' =>'required',
                    // 'spouse_income' =>'required',
                    // 'have_log_book'=>'required',
                    // 'model' => 'required',
                    // 'rego' => 'required',
                    // 'kms' => 'required',
                    // 'work_related_travel_expense' =>'required',
                    // 'work_related_travel_expense_amount' => 'required',
                    // 'uniform' =>'required',
                    // 'shoes' => 'required',
                    // 'laundry' => 'required',
                    // 'work_related_self_education_expense' => 'required',
                    // 'work_related_self_education_expense_amount' =>'required',
                    // 'mobile_phone_business' =>'required',
                    // 'mobile_phone_amount' =>'required',
                    // 'internet_business' =>'required',
                    // 'internet_amount' =>'required',
                    // 'computer_expense_business' =>'required',
                    // 'computer_expense_amount' =>'required',
                    // 'seminar_printing_books_business' =>'required',
                    // 'seminar_printing_books_amount' =>'required',
                    // 'tools_business' =>'required',
                    // 'tools_amount' =>'required',
                    // 'license_business' =>'required',
                    // 'license_amount' =>'required',
                    // 'union_fees_business' =>'required',
                    // 'union_fees_amount' =>'required',
                    // 'overtime_business' =>'required',
                    // 'overtime_amount' =>'required',
                    // 'others' =>'required',
                    // 'others_business' => 'required',
                    // 'others_amount' =>'required'

        ];

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

               $customerData = $this->customerService->update(request()->all(),$customer->id);

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
