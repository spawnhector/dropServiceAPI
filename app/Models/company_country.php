<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_country extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_nm',
    ];
}
