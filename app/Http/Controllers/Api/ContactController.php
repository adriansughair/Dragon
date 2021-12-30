<?php

namespace App\Http\Controllers\Api;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;


class ContactController extends BaseController
{
    public function add(Request $request)
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

        if ($contactUs->save()) {
            return $this->sendResponse($contactUs, 'success');
        }

        return $this->sendError('unexpected_error');
    }
}
