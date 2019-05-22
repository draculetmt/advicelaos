<?php

namespace App\Http\Controllers\users;


use App\Contact;
use App\Http\Requests\Contact\CreateContactRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{

    public function index()
    {
        return view('users.pages.contact');
    }

    public function save(CreateContactRequest $request)
    {
        Contact::create([

            'name' => $request->name,

            'email' => $request->email,

            'phone' => $request->phone,

            'content' => $request->content

        ]);

        session()->flash('success','Sent Contact Successfully');

        return redirect(route('contact.index'));
    }

}
