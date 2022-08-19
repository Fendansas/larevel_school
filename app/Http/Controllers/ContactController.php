<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function AdminContact(){

        $contacts = Contact::all();

        return view('admin.contact.index', compact('contacts'));
    }

    public function AdminAddContact(){

        return view('admin.contact.create');
    }


    public function AdminStoreContact(Request $request){

        Contact::insert([
            'phone' => $request->phone,
            'email'=> $request->email,
            'address'=>$request->address,
            'created_at'=> Carbon::now()
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact Inserted Successfully');

    }

    public function Edit($id){

        $contact = Contact::find($id);

        return view('admin.contact.edit', compact('contact'));

    }


    public function Update(Request $request,$id){

        Contact::find($id)->update([
            'email'=>$request->email,
            'address'=>$request->address,
            'phone'=> $request->phone
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Contact Updated Successfully');

    }

    public function Delete($id){
        Contact::find($id)->delete();

        return Redirect()->back()->with('success', 'Contact deleted Successfully');
    }

    public function Contact(){

        $contact = Contact::all()->first();

        return view('pages.contact', compact('contact'));
    }

    public function ContactForm(Request $request){

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('contact')->with('success', 'Message send');

    }

    public function AdminMessage(){
        $message = ContactForm::all();
        return view('admin.contact.message', compact('message'));
    }


}
