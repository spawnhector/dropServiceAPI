<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_temp_address extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'umi',
        'temp_address_id',
    ];

    public function member(){
        return $this->belongsTo(member::class,'member_id','id');
    }
    public function temp_address(){
        return $this->belongsTo(temp_address::class,'temp_address_id','id');
    }

    
}
