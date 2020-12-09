<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PasswordController extends Controller
{
    //
    public function index()
    {
        return view('auth.passwords.changePassword');
    }
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        Session::flash('statuscode', 'success');
        return redirect('/change-password')->with('status', 'Your password has been updated successfully.');

    }

}
