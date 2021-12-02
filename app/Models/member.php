<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class member extends Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $guard = 'member';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'trn',
        'country',
        'city',
        'state',
        'district',
        'postal'
    ];

    public function pickupAddress(){
        return company_address::where('country','=',Auth::user()->country)->first();
    }

    public function slide(){
        return $this->hasMany(slide::class,'member_id','id');
    }

}
