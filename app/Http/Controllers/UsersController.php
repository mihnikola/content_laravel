<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index(){

        $users = User::all();
        return view('admin.users.index', compact('users'));

    }

    public function show(User $user){

        return view('admin.users.profile', compact('user'));

    }

    public function update(User $user){

        $inputs = request()->validate([
            'username' => ['required','string','max:255','alpha_dash'],
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'avatar' => ['file']
        ]);

        if(request('avatar')){
            $inputs['avatar'] =request('avatar')->store('images');
        }
        $user->update($inputs);

        return back();
    }
    public function destroy(User $user){

        $user->delete();
        session()->flash('user-deleted','User was Deleted');

        return back();

    }


}
