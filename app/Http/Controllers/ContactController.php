<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::orderBy('created_at','desc')->paginate(5);
        return view('admin.pages.contact.listContact',compact('contacts'));
    }
    public function destroy($id){
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('contact')->with('message','Deleted Successfully');
    }
}
