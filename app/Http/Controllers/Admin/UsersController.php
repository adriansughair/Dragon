<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }
        if ($request->has('password') && $request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->name = $request->name;
        if ($request->has('email') && $request->email != null) {
            $user->email = $request->email;
        }
        if ($user->save()) {
            $request->session()->flash('success', $user->name . ' Has been Updated');
        } else {
            $request->session()->flash('error', 'Error updating the user');
        }

        return redirect()->route('admin.users.index', app()->getLocale());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $user->roles()->detach();
        if ($user->delete()) {
            $request->session()->flash('success', $user->name . ' Has been Deleted');
        } else {
            $request->session()->flash('error', 'Error deleting the user');
        }
        return redirect()->route('admin.users.index', app()->getLocale());
    }

    public function AuthRouteAPI(Request $request)
    {
        return $request->user();
    }
}
