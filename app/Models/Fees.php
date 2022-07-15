<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;

    const FEE_INTERVAL = [
        'monthly' => 'Monthly',
        '2_months' => '2 months',
        'quarterly' => 'Quarterly',
        'half_yearly' => 'Half Yearly',
        'yearly' => 'Yearly',
    ];
}
