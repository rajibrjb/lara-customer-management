<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGeneralInfo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'customer_general_infos';

    protected $casts = [
        'data' => 'array'
    ];

    protected $fillable = [
            'customer_id',
            'data',
            'TFN',
            'ABN',
            'BSB',
            'account_no',
            'spouse_name',
            'spouse_date_of_birth',
            'no_of_dependants',
            'spouse_income',
            'have_log_book',
            'model',
            'rego',
            'kms',
            'work_related_travel_expense',
            'work_related_travel_expense_amount',
            'uniform',
            'shoes',
            'laundry',
            'work_related_self_education_expense',
            'work_related_self_education_expense_amount',
            'mobile_phone_business',
            'mobile_phone_amount',
            'internet_business',
            'internet_amount',
            'computer_expense_business',
            'computer_expense_amount',
            'seminar_printing_books_business',
            'seminar_printing_books_amount',
            'tools_business',
            'tools_amount',
            'license_business',
            'license_amount',
            'union_fees_business',
            'union_fees_amount',
            'overtime_business',
            'overtime_amount',
            'others',
            'others_business',
            'others_amount'


    ];



    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id', 'customer_id');
    }
}
