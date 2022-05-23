<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\CustomerGeneralInfo;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CustomerService
{

    public function __construct()
    {

    }

    /**
     * Delete customer by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $customer = $this->customerRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete customer data');
        }

        DB::commit();

        return $customer;

    }

    /**
     * Get all customer.
     *
     * @return String
     */
    public function getAll()
    {
        return Customer::all();
    }

    /**
     * Get customer by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return Customer::find($id);
    }

    /**
     * Update customer data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update($data, $id)
    {
        $validator = Validator::make($data, [
            'title' => 'bail|min:2',
            'description' => 'bail|max:255'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $customer = Customer::find($id);

            $customer->update($data);
            $genInfo = [
                'ABN' => $data['ABN'],
            ];
           $asda =  $customer->customer_general_info()->update($genInfo);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update customer data');
        }

        DB::commit();

        return $customer;

    }

    /**
     * Validate customer data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function save($payload)
    {


        $customer = Customer::Create($payload);
        $customerGeneralInfo =$customer->customer_general_info()->Create($payload);
        return;
    }

}
