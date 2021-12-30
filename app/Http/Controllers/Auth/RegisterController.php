<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
            'whatsapp' => ['string', 'max:255', 'unique:users'],
        ]);

        $user = User::create([
            'name' => "guest",
            'phone_number' => $request->input('phone_number'),
            'whatsapp' => $request->has('whatsapp') ? $request->input('whatsapp') : '',
            'password' => Hash::make($this->generatePassword()),
        ]);

        $role = Role::select('id')->where('name', 'user')->first();

        $user->roles()->attach($role);

        return redirect()->route('login', app()->getLocale());

        return $user;
    }

    private function generatePassword($length = 12)
    {
        $chars = 'abcdefghijkl!@#$%^&*mnopqrstuvwxyzABCDEFGHIJKLMNOPQRST!@#$%^&*(UVWXYZ0123456789!@#$%^&*();:';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
}
