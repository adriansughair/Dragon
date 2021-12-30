<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email',
            'subject' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);

        $contactUs = new ContactUs();

        $contactUs->name = $request->input('name');
        $contactUs->email = $request->has('email') ? $request->input('email') : null;
        $contactUs->phone = $request->input('phone');
        $contactUs->subject = $request->input('subject');
        $contactUs->message = $request->input('message');

        $contactUs->save();
    }
}
