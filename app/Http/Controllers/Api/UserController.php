<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\EditProfileRequest;
use App\Models\User;
use App\Models\Country;
use App\Models\UserPhoneVerify;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    public function countries(Request $request){
         $lang = $request->lang;
         $countries = Country::get();
         if(count($countries)>0){
            
            foreach($countries as $country){
                $arr['id']=  $country->id;
                $arr['name']=  $country->translate($lang)->name;
                $data[] = $arr;
            }
           return response([
            'status' =>true ,
            'message' =>trans('countries')  ,
            'data' =>$data
        ]);         
        }else{
            return response([
                'status' =>false ,
                'message' =>trans('You don have any countries')  ,
                'data' =>[]
            ]); 
        }
    }

    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id_number'     => 'required',
            'name'          => 'required',
            'phone'         => 'required|unique:users,phone',
            'nationality'   => 'required',
            'birthrate'     => 'required',
            'age'           => 'required',
            'gender'        => 'required',
            'ID_image'      => 'required',
            'device_token'      => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|max:150|min:3' ,
        ]);
       if ($validator->passes()) {
            if($request->hasFile('ID_image'))
            {
                $fileName = upload_image($request->file('ID_image'), 'ID_image');
            }
            $data1 = $request->all();
            $data1['ID_image'] = $fileName;
            $data1['password'] = bcrypt($request->password);
            $user = User::create($data1);
            $random_number = random4DigitNumberGenerator();
            UserPhoneVerify::create([
                'phone_number' =>  $user->phone,
                'code' => $random_number,
                'status' => 'active'
            ]);
            $data['activation_code'] = $random_number;
            return response([
                'status' =>true ,
                'message' =>trans('api.code_sent')  ,
                'data' =>$data
            ]); 
        } else {
            foreach ((array)$validator->errors() as $value){
                if (isset($value['id_number'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.id_number_required') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['name'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.name_required') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['email'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.emil_requird') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['phone'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.phone_problem') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['nationality'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.nationality_requred') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['birthrate'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.birthrate_required') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['age'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.age_required') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['gender'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.gender_required') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['ID_image'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.ID_required') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['device_token'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.device_token_required') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['password'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.password_requred') ,
                        'data' =>[]
                    ]);
                } else{
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.fail') ,
                        'data' =>[]
                    ]);
                }
            } 
       }
    }
    
    public function code_check(Request $request){
        $validator=Validator::make($request->all(),[
            'phone'=>'required',
            'code'=>'required'
        ]);
        if ($validator->passes()) {
            $UserPhoneVerify = UserPhoneVerify::where('phone_number' ,$request->phone)
            ->where('code',$request->code)->first();
            if($UserPhoneVerify){
            if($UserPhoneVerify->status == 'active'){
                    $UserPhoneVerify->status = 'not_active';
                    $UserPhoneVerify->save();
                    $user = User::where('phone',$request->phone)->first();
                    $token = $user->createToken('LaravelAuthApp')->accessToken;
                    $data['id'] = $user->id;
                    $data['id_number'] = $user->id_number;
                    $data['name'] = $user->name;
                    $data['phone'] = $user->phone;
                    $data['nationality'] = $user->nationality;
                    $data['birthrate'] = $user->birthrate;
                    $data['age'] = $user->age;
                    $data['gender'] = $user->gender;
                    $data['email'] = $user->email;
                    $data['device_token'] = $user->device_token;
                    $data['ID_image'] = asset($user->ID_image);
                    $data['token'] = $token;
                    return response([
                        'status' =>true ,
                        'message' =>trans('api.registered')  ,
                        'code' =>$data
                    ]); 
            }else{
                    return response([
                        'status' =>false ,
                        'message' =>trans('api.code_not_active')  ,
                        'data' =>[]
                    ]);  
            }
            }else{
                return response([
                    'status' =>false ,
                    'message' =>trans('api.code_not_correct')  ,
                    'data' =>[]
                ]);    
            }
         }else{
            foreach ((array)$validator->errors() as $value){
                if (isset($value['phone'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.phone_required') ,
                        'data' =>[]
                    ]);
                }elseif (isset($value['code'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.code_requred') ,
                        'data' =>[]
                    ]);
                }  else{
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.fail') ,
                        'data' =>[]
                    ]);
                }
             }
         }
    }

     /**
     * Login
     */
    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'phone'         => 'required',
            'password'      => 'required' ,
        ]);
       if ($validator->passes()) {
        $user = [
            'phone'    => $request->phone,
            'password' => $request->password
        ];
        if (auth()->attempt($user)) {
            $user =User::where('phone',$user['phone'])->first();

            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $data['id'] = $user->id;
            $data['id_number'] = $user->id_number;
            $data['name'] = $user->name;
            $data['phone'] = $user->phone;
            $data['nationality'] = $user->nationality;
            $data['birthrate'] = $user->birthrate;
            $data['age'] = $user->age;
            $data['gender'] = $user->gender;
            $data['email'] = $user->email;
            $data['ID_image'] = asset($user->ID_image);
            $data['token'] = $token;

            return response([
                'status' =>true ,
                'message' =>trans('api.logined')  ,
                'data' =>$data
            ]); 
        }
      }else{
        foreach ((array)$validator->errors() as $value){
            if (isset($value['phone'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.phone_problem') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['password'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.password_requred') ,
                    'data' =>[]
                ]);
            }  else{
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.fail') ,
                    'data' =>[]
                ]);
            }
         }
       }
    }  
    
    public function change_password(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'oldPassword'=>'required',
            'newPassword'=>'required'
        ]);
        if ($validator->passes()) {
        $user = User::find(Auth()->user()->id);
       if(Hash::check($request->oldPassword,$user->password)){
        $user->password = bcrypt($request->newPassword);
        $user->save();
        return response([
                'status' =>true ,
                'message' =>trans('api.password_updated')  ,
                'data' =>[]
            ]);               
       }else{
        return response([
                'status' =>false ,
                'message' =>trans('api.oldPassword_not_correct')  ,
                'data' =>[]
            ]);    
       }
     }else{
        foreach ((array)$validator->errors() as $value){
            if (isset($value['newPassword'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.newPassword_required') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['oldPassword'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.oldPassword_requred') ,
                    'data' =>[]
                ]);
            }else{
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.fail') ,
                    'data' =>[]
                ]);
            }
         }
       }
 
    }
    
    public function getProfileData(Request $request)
    {
        $user = auth()->user();
        if ($user){
            $data['id'] = $user->id;
            $data['id_number'] = $user->id_number;
            $data['name'] = $user->name;
            $data['phone'] = $user->phone;
            $data['nationality'] = $user->nationality;
            $data['birthrate'] = $user->birthrate;
            $data['age'] = $user->age;
            $data['gender'] = $user->gender;
            $data['email'] = $user->email;
            $data['device_token'] = $user->device_token;
            $data['ID_image'] = asset($user->ID_image);
            $data['token'] = "";
            return response([
                'status' =>true ,
                'message' =>trans('api.user_profile')  ,
                'data' =>$data
            ]); 
         }
        else{
            return response([
                'status' =>false ,
                'message' =>trans('api.user_not_found')  ,
                'data' =>[]
            ]); 
        }
    }

    public function updateProfile(Request $request){
        $validator=Validator::make($request->all(),[
            'id_number'     => 'required',
            'name'          => 'required',
            'phone'         => 'required|unique:users,phone,'.Auth()->user()->id,
            'nationality'   => 'required',
            'birthrate'     => 'required',
            'age'           => 'required',
            'gender'        => 'required',
            'email'         => "required|email|unique:users,email,".Auth()->user()->id,
        ]);
       if ($validator->passes()) {
        
        $user = auth()->user();
        $data1 = $request->all();
        if($request->hasFile('ID_image'))
        {
            $data1['ID_image'] = upload_image($request->file('ID_image'), 'ID_image');
        }
        if($request->hasFile('image'))
        {
            $data1['image'] = upload_image($request->file('image'), 'image');
        }
        $user->fill($data1)->save();
        $data['id'] = $user->id;
        $data['id_number'] = $user->id_number;
        $data['name'] = $user->name;
        $data['phone'] = $user->phone;
        $data['nationality'] = $user->nationality;
        $data['birthrate'] = $user->birthrate;
        $data['age'] = $user->age;
        $data['gender'] = $user->gender;
        $data['email'] = $user->email;
        $data['device_token'] = $user->device_token;
        $data['ID_image'] = asset($user->ID_image);
        $data['image'] = asset($user->image);
        $data['token'] = "";
        return response([
            'status' =>true ,
            'message' =>trans('success.user_updated')  ,
            'data' =>$data
        ]);  
    } else {
        foreach ((array)$validator->errors() as $value){
            if (isset($value['id_number'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.id_number_required') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['name'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.name_required') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['email'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.emil_requird') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['phone'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.phone_problem') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['nationality'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.nationality_requred') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['birthrate'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.birthrate_required') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['age'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.age_required') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['gender'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.gender_required') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['ID_image'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.ID_required') ,
                    'data' =>[]
                ]);
            }elseif (isset($value['device_token'])) {
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.device_token_required') ,
                    'data' =>[]
                ]);
            } else{
                return response()->json([
                    'status' =>false ,
                    'message' =>trans('api.fail') ,
                    'data' =>[]
                ]);
            }
        } 
   }
    }
    public function update_device_token(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'device_token'=>'required',
        ]);
        if ($validator->passes()) {
            $user_id = Auth()->user()->id;
            $user = User::find($user_id);
            $user->device_token = $request->device_token;
            $user->save();
            return response([
                'status' =>true ,
                'message' =>trans('api.device_token_updated')  ,
                'data' =>[]
            ]); 
        }else{
            foreach ((array)$validator->errors() as $value){
                if (isset($value['device_token'])) {
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.device_token_required') ,
                        'data' =>[]
                    ]);
                }else{
                    return response()->json([
                        'status' =>false ,
                        'message' =>trans('api.fail') ,
                        'data' =>[]
                    ]);
                } 
             }
        }
    }
}
 