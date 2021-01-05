<?php

namespace App\Http\Controllers;

use App\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function verifyMobile(Request $request)
    {
        $otp = $request->otp;
        $user = User::find(Auth::user()->id);
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
        $users = User::all();
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

    public function updateMobile(Request $request, User $user)
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

    public function email()
    {
        $user = User::find(Auth::user()->id);
        return view('email.index')->with([
            'user' => $user
        ]);
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);
        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->save();
        
        return redirect()->back()->with('status', 'Your Email has been updated successfully');
    }


    public function store(Request $request){
        $request->validate([
                'name' => 'required',
                'mobile' => 'required|unique:users,mobile|int|regex:/[0-9]{10}/|digits:10',
                'email' => 'nullable|email|unique:users,email',
            ]);
        $mobile = ltrim($request->mobile, '0');
        $email = $request->input('email') ? $request->input('email') : $mobile.'@fishfarm.pk';
        $password = mt_rand(100000,999999);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $email,
            'mobile' => $request->input('mobile'),
            'verification_code' => rand(1000, 9999),
            'is_verified' => 1,
            'password' => Hash::make($password),
        ]);

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:users,mobile,'.$user->id.'|int|regex:/[0-9]{10}/|digits:10',
            'email' => 'nullable|email|unique:users,email,'.$user->id,
            'role' => 'required',
        ]);
        $mobile = ltrim($request->mobile, '0');
        $email = $request->input('email') ? $request->input('email') : $mobile.'@fishfarm.pk';
        $user->update([
            'name' => $request->input('name'),
            'email' => $email,
            'mobile' => $request->input('mobile'),
            'role' => $request->input('role'),
            'is_verified' => 1,
        ]);

        return response()->json($user);

    }
    public function destroy(Request $request, $id){
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    
    }

    public function mobileUpdate(Request $request, User $user)
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
