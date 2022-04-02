<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::orderBy('id', 'DESC')->paginate(25);
        return view('dashboard.contact.index',compact('contacts'));
    }

    public function details($id){
        $contact = Contact::find($id);
        return view('dashboard.contact.show',compact('contact'));
    }
}
