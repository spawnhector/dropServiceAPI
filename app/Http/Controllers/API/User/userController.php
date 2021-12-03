<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\activty;
use App\Models\member;
use App\Models\member_temp_address;
use App\Models\prealert;
use App\Models\slide;
use App\Models\package;
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
        $login = Auth::guard('member')->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        if ($login) {
            slide::create([
                'member_id'=>$user->id,
                'name'=>'prealert',
                'status'=>'0',
            ]);
            slide::create([
                'member_id'=>$user->id,
                'name'=>'package',
                'status'=>'0',
            ]);
            slide::create([
                'member_id'=>$user->id,
                'name'=>'transit',
                'status'=>'0',
            ]);
            slide::create([
                'member_id'=>$user->id,
                'name'=>'delivered',
                'status'=>'0',
            ]);
            $reArr['token'] = $user->createToken('api-application')->accessToken;
            activty::create([
                'member_id'=>$user->id,
                'name'=>'Registration',
                'activity'=>'New account created'
            ]);
            return response()->json($reArr,200);
        } else {
            # code...
        }
        
    }

    public function login(Request $request){

        if(Auth::guard('member')->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])){
            $user = Auth::guard('member')->user();
            $reArr['token'] = $user->createToken('api-application')->accessToken;
            activty::create([
                'member_id'=>$user->id,
                'name'=>'Login',
                'activity'=>'Login Successfull'
            ]);
            return response()->json($reArr,200);
        }else{
            return Response()->json(['error'=>'Unauthorize User'],203);
        }

    }

    public function logout(Request $request) {

        $token = $request->user()->token();
        if ($token->revoke()) {
            activty::create([
                'member_id'=>Auth::user()->id,
                'name'=>'Logout',
                'activity'=>'Logout Successfull'
            ]);
            $response = ['success' => 'You have been successfully logged out!'];
    
            return response()->json($response, 200);
        } else {
            $response = ['error' => 'Something went wrong'];
    
            return response()->json($response, 202);
        }

    }

    public function updateProgress(Request $request){
        if ($request->name) {
            $find = member::find($request->id);
            $find->name = $request->name;
            $find->profile_prog = $request->prog;
            $find->save();
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile name updated, Progress '.Auth::user()->profile_prog.'%'
            ]);
            return Response()->json([
                'message' => 'member name updated'
            ],200);
        }
        if ($request->dob) {
            $find = member::find($request->id);
            $find->dob = $request->dob;
            $find->profile_prog = $request->prog;
            $find->save();
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile date of birth updated, Progress '.Auth::user()->profile_prog.'%'
            ]);
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->org) {
            $find = member::find($request->id);
            $find->organization = $request->org;
            $find->profile_prog = $request->prog;
            $find->save();
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile organization updated'
            ]);
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->email) {
            $find = member::find($request->id);
            $find->email = $request->email;
            $find->profile_prog = $request->prog;
            $find->save();
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile email updated, Progress '
            ]);
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->number) {
            $find = member::find($request->id);
            $find->phone = $request->number;
            $find->profile_prog = $request->prog;
            $find->save();
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile number updated, Progress '.Auth::user()->profile_prog.'%'
            ]);
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
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile address updated, Progress '.Auth::user()->profile_prog.'%'
            ]);
            return Response()->json([
                'message'=>'yes'
            ],200);
        }
        if ($request->trn) {
            $find = member::find($request->id);
            $find->trn = $request->trn;
            $find->profile_prog = $request->prog;
            $find->save();
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile tax registration number updated, Progress '.Auth::user()->profile_prog.'%'
            ]);
            return Response()->json([
                'message'=>'yes'
            ],200);
        }

        if ($request->t_c) {
            $find = member::find($request->id);
            $find->t_c = $request->t_c;
            $find->profile_prog = $request->prog;
            $find->save();
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile terms and conditions accepted, Progress '.Auth::user()->profile_prog.'%'
            ]);
            return Response()->json([
                'message'=>'yes'
            ],200);
        }

        if ($request->p_p) {
            $find = member::find($request->id);
            $find->p_p = $request->p_p;
            $find->profile_prog = $request->prog;
            $find->save();
            activty::create([
                'member_id'=>$request->id,
                'name'=>'Progress',
                'activity'=>'Profile privacy and policy accepted, Progress '.Auth::user()->profile_prog.'%'
            ]);
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
            $count = count(prealert::where('umi','=',$request->umi)->get());
            if ($count >= 3) {
                $slide = slide::find(1);
                if ($slide->status != 3  && $slide->status == 0) {
                    $slide->status = 1;
                    $slide->save();
                    activty::create([
                        'member_id'=>Auth::user()->id,
                        'name'=>'Prealert',
                        'activity'=>'Pre-alert create with nick name: '.$request->package_nm.''
                    ]);
                    activty::create([
                        'member_id'=>Auth::user()->id,
                        'name'=>'Slide',
                        'activity'=>'Pre-alert slide enabled'
                    ]);
                    return response()->json([
                        'success'=>'Pre-alert created, slide enabled'
                    ],200);
                }
            }
            
            activty::create([
                'member_id'=>Auth::user()->id,
                'name'=>'Prealert',
                'activity'=>'Pre-alert create with nick name: '.$request->package_nm.''
            ]);
            return response()->json([
                'success'=>'Prealert created'
            ],200);
        } else {
            return response()->json([
                'error'=>'Something went wrong'
            ],202);
        }
    }

    public function updatePreAlert(Request $request){
        $update = prealert::find($request->id);
        $update->package_nm = $request->package_nm;
        $update->track_nm = $request->track_nm;
        $update->shipper = $request->shipper;
        $update->content = $request->content;
        $update->invoice_total = $request->invoice_total;
        $update->courier = $request->courier;
        $update->weight = $request->weight;
        $update->file = $request->file;
        $update->promo_code = $request->promo_code;

        if ($update->update()) {
            return response()->json([
                'success'=>'Prealert updated'
            ],200);
        } else {
            return response()->json([
                'error'=>'Something went wrong'
            ],202);
        }
    }

    public function deletePreAlert($id){
        $prealert = prealert::find($id);
        $name = $prealert->package_nm;
        if ($prealert->delete()) {
            activty::create([
                'member_id'=>Auth::user()->id,
                'name'=>'Prealert',
                'activity'=>'Pre-alert "'.$name.'" deleted'
            ]);
            return response()->json([
                'success'=>'Prealert deleted'
            ],200);
        } else {
            return response()->json([
                'error'=>'Something went wrong'
            ],202);
        }
    }

    public function getSlide(){
        return response()->json(['success'=>slide::where('member_id','=',Auth::user()->id)->get()],200);
    }

    public function enableSlide(Request $request){

        if (!$request->has('bypass')) {
            if (count(package::where('umi','=',$request->umi)->get()) == 0) {
                return response()->json([
                    'error'=>'No package available, slide can not be enable.'
                ],202);
            }
        }

        $slide = slide::find($request->id);
        $slide->status = $request->status;
        
        if ($slide->update()) {
            return response()->json([
                'success'=>'slide updated'
            ],200);
        } else {
            return response()->json([
                'error'=>'Something went wrong'
            ],202);
        }
    }
    public function disableSlide(Request $request){

        $slide = slide::find($request->id);
        $slide->status = $request->status;
        
        if ($slide->update()) {
            return response()->json([
                'success'=>'slide disabled'
            ],200);
        } else {
            return response()->json([
                'error'=>'Something went wrong'
            ],202);
        }
    }

    public function activity(){
        $activity = activty::where('member_id','=',Auth::user()->id)->latest()->get();
        if (count($activity) != 0) {
            return response()->json([
                'success'=>$activity
            ],200);
        } else {
            return response()->json([
                'error'=>'Something went wrong'
            ],202);
        }
    }
}
