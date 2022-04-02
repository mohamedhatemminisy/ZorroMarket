<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'DESC')->paginate(25);
        return view('dashboard.user.index',compact('users'));
    }

    public function details ($id){
        $user = User::find($id);
        return view('dashboard.user.show',compact('user'));  
    }

    public function addresses($user_id){
        $addresses = Address::where('user_id',$user_id)->get();
        return view('dashboard.user.addresses',compact('addresses'));  
    }

    public function reservations($user_id){
        $visits = Visit::where('user_id',$user_id)->paginate(25);
        return view('dashboard.user.visit',compact('visits'));  
    }
}
