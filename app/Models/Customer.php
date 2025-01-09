<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Customer extends Model
{
    use Billable;

    protected $fillable = [
        'name',
        'email',
    ];
}
