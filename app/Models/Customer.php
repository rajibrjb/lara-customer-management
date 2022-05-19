<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    public function customer_general_info(): HasOne
    {
        return $this->hasOne(CustomerGeneralInfo::class);
    }
}
