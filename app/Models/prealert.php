<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prealert extends Model
{
    use HasFactory;

    protected $fillable = [
        'umi',
        'package_nm',
        'track_nm',
        'shipper',
        'content',
        'invoice_total',
        'courier',
        'weight',
        'file',
        'promo_code',
    ];
}
