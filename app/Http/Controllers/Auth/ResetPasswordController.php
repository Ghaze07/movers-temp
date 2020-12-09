<?php

namespace App\Http\Controllers\Auth;

use App\Sms;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Facades\CUTTLYFacade;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function sendResetLinkSms(Request $request)
    {
        $mobile = ltrim($request->mobile, '0');
        $user = User::where ('mobile', $mobile)->first();
        Session::flash('statuscode', 'success');
        if ( !$user ) return redirect()->back()->with('mobile_number_error_status', 'we can not find user with this mobile number');
        //creating a new token for a reset link which will be sent to the user. 
         DB::table('password_resets')->insert([
            'email' => $user->email,
            'mobile' => $user->mobile,
            'token' => Str::random(10),
        ]);

        $tokenData = DB::table('password_resets')->where('mobile', $mobile)->first();
        $token = $tokenData->token;
        $mobile = $tokenData->mobile;
        $email = $tokenData->email;

        $user = User::where('mobile', $mobile)->first();
        $link = url('password/reset'. $token).'?email='.$email;

        // cuttly api for making short link 
        $shortlink = CUTTLYFacade::getShortLink($link);
        
        //generating sms which will carry password reset link
        $sms = new Sms;
            $sms->user_id = $user->id;
            $sms->to = $mobile;
            $sms->body = "You can set your password using this link : {$shortlink}";
            $sms->save();    
        return redirect()->back()->with('mobilestatus', 'We have sent password reset link on your mobile please follow that link ');
    }

    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

                    if(strlen($request->token) > 10 ){
                        // Here we will attempt to reset the user's password. If it is successful we
                        // will update the password on an actual user model and persist it to the
                        // database. Otherwise we will parse the error and return the response.
                        $response = $this->broker()->reset(
                            $this->credentials($request), function ($user, $password) {
                                $this->resetPassword($user, $password);
                            }
                        );

                        // If the password was successfully reset, we will redirect the user back to
                        // the application's home authenticated view. If there is an error we can
                        // redirect them back to where they came from with their error message.
                        return $response == Password::PASSWORD_RESET
                                    ? $this->sendResetResponse($request, $response)
                                    : $this->sendResetFailedResponse($request, $response);
                    } else {
                        
                        $user = User::where('email', $request->email)->first();
                
                        $password = $request->password;
                        $user->password = Hash::make($password);
                        $user->save();
                
                        // Deleting the token record from password reset table once password has been reset  
                        DB::table('password_resets')->where('email', $user->email)->delete();
                
                        $this->guard()->login($user);
                
                        return redirect('/');
                    }


    }


}
