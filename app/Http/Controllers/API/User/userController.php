<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\member;
use App\Models\member_temp_address;
use App\Models\prealert;
use App\Models\temp_address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class userController extends Controller
{
    public function register(Request $request){
        $validation = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(),202);
        }
        $allData = $request->all();
        $allData['password'] = Hash::make($allData['password']);

        $user = member::create($allData);
        Auth::guard('member')->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        
        $reArr['token'] = $user->createToken('api-application')->accessToken;

        return response()->json($reArr,200);
    }

    public function login(Request $request){

        if(Auth::guard('member')->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])){
            $user = Auth::guard('member')->user();
            $reArr['token'] = $user->createToken('api-application')->accessToken;
            return response()->json($reArr,200);
        }else{
            return Response()->json(['error'=>'Unauthorize User'],203);
        }

    }

    public function updateProgress(Request $request){
        if ($request->name) {
            $find = member::find($request->id);
            $find->name = $request->name;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message' => 'member name updated'
            ],200);
        }
        if ($request->dob) {
            $find = member::find($request->id);
            $find->dob = $request->dob;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->org) {
            $find = member::find($request->id);
            $find->organization = $request->org;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->email) {
            $find = member::find($request->id);
            $find->email = $request->email;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->number) {
            $find = member::find($request->id);
            $find->phone = $request->number;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->address) {
            $find = member::find($request->id);
            $find->country = $request->country;
            $find->city = $request->city;
            $find->state = $request->state;
            $find->district = $request->district;
            $find->postal = $request->postal;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->trn) {
            $find = member::find($request->id);
            $find->trn = $request->trn;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message'=>'yes'
            ],200);
        }

        if ($request->t_c) {
            $find = member::find($request->id);
            $find->t_c = $request->t_c;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message'=>'yes'
            ],200);
        }

        if ($request->p_p) {
            $find = member::find($request->id);
            $find->p_p = $request->p_p;
            $find->profile_prog = $request->prog;
            $find->save();
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
    }

    public function generateTempAddress(){
        if (member_temp_address::where('member_id','=',Auth::user()->id)->first()) {
            $result['success'] = member_temp_address::with('temp_address')->where('member_id','=',Auth::user()->id)->first();
            $result['pickup_address'] = Auth::user()->pickupAddress();
            return response()->json($result,200);
        } else {
            $did = false;
            if (auth::user()->country == 'Jamaica') {
                $tempId = temp_address::where('country','=','Miami')->first()->id;
                $check = count(member_temp_address::get());
                $check++;
                $umi = str_pad($check, 6, "0", STR_PAD_LEFT); 
                $store = member_temp_address::create([
                    'member_id' => auth::user()->id,
                    'umi' => 'LF'.$umi.'',
                    'temp_address_id' => $tempId
                ]);
                if ($store) {
                    $result['success'] = member_temp_address::with('temp_address')->where('member_id','=',Auth::user()->id)->first();
                    $result['pickup_address'] = Auth::user()->pickupAddress();
                    $did = true;
                }else{
                    $result['error'] = 'something went wrong';
                }
            }
            if ($did) {
                return response()->json($result,200);
            } else {
                return response()->json($result,203);
            }
        }
        
    }

    public function preAlert(Request $request){
        $pre = prealert::where('umi','=',$request->umi)->get();

        if (count($pre) != 0) {
            return response()->json([
                'success'=>$pre
            ],200);
        }

        return response()->json([
            'success'=> 'empty'
        ],200);
    }

    public function createPreAlert(Request $request){
        
        if (prealert::create($request->all())) {
            return response()->json([
                'success'=>'Prealert created'
            ],200);
        } else {
            return response()->json([
                'error'=>'Something went wrong'
            ],202);
        }
    }
}
