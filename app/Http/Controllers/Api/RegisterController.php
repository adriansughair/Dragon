<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $request->validate([
            'phone_number' => 'required|unique:users',
            'whatsapp' => 'unique:users',
        ]);

        $user = new User();

        $user->phone_number = $request->input('phone_number');
        $user->password = Hash::make($this->generatePassword());
        $user->name = "guest";
        $user->whatsapp = $request->has('whatsapp') ? $request->has('whatsapp') : '';

        $user->save();

        $role = Role::select('id')->where('name', 'user')->first();

        $user->roles()->attach($role);

        return $this->sendResponse($this->getUserResponse($user), 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // @todo: implement more security [confirmation code or ]
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError([$request->phone_number], 'validation_error');
        }

        $user = User::where('phone_number', $request->input('phone_number'))->get()->first();

        if ($user) {
            Auth::login($user);
            $success = $this->getUserResponse($user);
            $user2 = $user->newQuery()->where('phone_number', $request->input('phone_number'));
            $data = $user2->get();
            return $this->sendResponse($success,$data);
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
    
    public function getinfo()
    {
        // @todo: implement more security [confirmation code or ]
      
        
        
        
        $user = User::where('id', $_GET['id'])->get()->first();
        
       return $user;
    }
    
    

    private function getUserResponse(User $user, $new = false)
    {
        $data = [
            'token' => $user->createToken('MyApp')->accessToken,
            'phone_number' => $user->phone_number,
            'roles' => $user->roles()->get()->pluck('name')->toArray(),
            'is_active' => $user->is_active,
        ];
        return $data;
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
