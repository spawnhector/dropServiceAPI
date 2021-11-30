<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\member;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function user($id){
        return Response()->json(member::find($id));
    }
}
