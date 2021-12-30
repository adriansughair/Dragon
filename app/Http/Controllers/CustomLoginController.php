<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required'
        ]);

        $user = User::where('phone_number', $request->phone_number)->get()->first();
        if ($user && $user->id != 1 && !$user->hasRole('admin')) {
            Auth::login($user);
            return redirect()->route('home', app()->getLocale());
        } else {
            $request->session()->flash('error', __('User does\'nt exist'));
            return redirect()->route('login', app()->getLocale());
        }
    }
}
