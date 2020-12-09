<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function verifyMobile(Request $request)
    {
        $otp = $request->otp;
        $user = \Auth::user();
        if ($user->verification_code == $otp) {
            $user->is_verified = true;
            $user->save();
            return json_encode(['status' => true, 'message' => 'Mobile number verified successfully.']);
        }else{
            return json_encode(['status' => false, 'message' => 'Invalid OTP.']);
        }
    }

    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(20);
        return view('user.index')->with([
            'users' => $users
        ]);
    }
    public function mobile()
    {
        $user = User::find(Auth::user()->id);
        return view('mobile.index')->with([
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'mobile' => ['required'],
        ]);
        $user = User::find(Auth::user()->id);
        $user->mobile = $request->input('mobile');
        $user->is_verified = 0;
        $user->verification_code = rand(1000, 9999);
        $user->save(); 
        
        return redirect('/');
    
    }


}
