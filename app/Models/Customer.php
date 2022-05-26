<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'customers';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'date_of_birth',
        'title',
        'address',
        'phone',
        'email'
    ];


    public function customer_general_info()
    {
        return $this->hasOne(CustomerGeneralInfo::class, 'customer_id', 'id');
    }
}
