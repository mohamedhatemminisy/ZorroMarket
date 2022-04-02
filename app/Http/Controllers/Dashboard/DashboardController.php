<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Test;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $tests = Test::get()->count();
        $offers = User::get()->count();
        $visits = Contact::get()->count();

        $lastOffers = User::orderBy('id','DESC')->take(5)->get();
        $lastTests  = Test::orderBy('id','DESC')->take(5)->get();
        $lastVisit  = Contact::orderBy('id','DESC')->take(5)->get();
        return view('dashboard.index',compact('tests','offers','visits',
        'lastOffers','lastTests','lastVisit'));
    }
}
