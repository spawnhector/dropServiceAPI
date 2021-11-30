<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_address extends Model
{
    use HasFactory;
    protected $fillable = [
        'country',
        'city',
        'state',
        'district',
        'zip'
    ];
}
