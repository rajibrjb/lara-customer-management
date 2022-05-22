<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'customers';

    protected $fillable = [
        'id','first_name',
        'last_name',
        'date_of_birth',
        'title',
        'state',
        'phone',
        'email'
        
    ];


    public function customer_general_info(): HasOne
    {
        return $this->hasOne(CustomerGeneralInfo::class);
    }
}
