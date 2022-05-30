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
            $genInfo = [];
            if(isset($data['abn']))
            {
                $genInfo['abn'] = $data['abn'];
            }
            if(isset($data['tfn']))
            {
                $genInfo['tfn'] = $data['tfn'];
            }
            if(isset($data['account_no']))
            {
                $genInfo['account_no'] = $data['account_no'];
            }
            // if(isset($data['data']))
            // {
            //     $genInfo['data'] = $data['data'];
            // }
            // $genInfo = [
            //     // 'abn' => $data['abn'],
            //     // 'tfn' => $data['tfn'],
            //     // 'bsb' => $data['bsb'],
            //     // 'account_no' => $data['account_no'],
            //     // 'spouse_name' => $data['spouse_name'],
            //     // 'spouse_date_of_birth' => $data['spouse_date_of_birth'],
            //     // 'no_of_dependants' => $data['no_of_dependants'],
            //     // 'spouse_income' => $data['spouse_income'],
            //     // 'have_log_book' => $data['have_log_book'],
            //     // 'model' => $data['model'],
            //     // 'rego' => $data['rego'],
            //     // 'kms' => $data['kms'],
            //     // 'work_related_travel_expense' => $data['work_related_travel_expense'],
            //     // 'work_related_travel_expense_amount' => $data['work_related_travel_expense_amount'],
            //     // 'uniform' => $data['uniform'],
            //     // 'shoes' => $data['shoes'],
            //     // 'laundry' => $data['laundry'],
            //     // 'work_related_self_education_expense' => $data['work_related_self_education_expense'],
            //     // 'work_related_self_education_expense_amount' => $data['work_related_self_education_expense_amount'],
            //     // 'mobile_phone_business' => $data['mobile_phone_business'],
            //     // 'mobile_phone_amount' => $data['mobile_phone_amount'],
            //     // 'internet_business' => $data['internet_business'],
            //     // 'internet_amount' => $data['internet_amount'],
            //     // 'computer_expense_business' => $data['computer_expense_business'],
            //     // 'computer_expense_amount' => $data['computer_expense_amount'],
            //     // 'seminar_printing_books_business' => $data['seminar_printing_books_business'],
            //     // 'seminar_printing_books_amount' => $data['seminar_printing_books_amount'],
            //     // 'tools_business' => $data['tools_business'],
            //     // 'tools_amount' => $data['tools_amount'],
            //     // 'license_business' => $data['license_business'],
            //     // 'license_amount' => $data['license_amount'],
            //     // 'union_fees_business' => $data['union_fees_business'],
            //     // 'union_fees_amount' => $data['union_fees_amount'],
            //     // 'overtime_business' => $data['overtime_business'],
            //     // 'overtime_amount' => $data['overtime_amount'],
            //     // 'others' => $data['others'],
            //     // 'others_business' => $data['others_business'],
            //     // 'others_amount' => $data['others_amount']


            // ];



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
