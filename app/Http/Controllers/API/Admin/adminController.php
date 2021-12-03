<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\activty;
use App\Models\member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function user($id){
        return Response()->json(member::find($id));
    }

    
    public function login(Request $request){

        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])){
            $user = Auth::user();
            $reArr['token'] = $user->createToken('api-application')->accessToken;
            return response()->json($reArr,200);
        }else{
            return Response()->json(['error'=>'Unauthorize User'],203);
        }

    }
}
