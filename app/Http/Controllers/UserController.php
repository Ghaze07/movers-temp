<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
