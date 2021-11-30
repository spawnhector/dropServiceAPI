<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_address extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_country_id',
        'city',
        'state',
        'district',
        'zip',
    ];
}
