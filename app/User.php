<?php

namespace App;

use App\Facades\SMS;
use App\Facades\SMSFacade;
use Illuminate\Support\Str;
use App\Facades\CUTTLYFacade;
use Illuminate\Support\Facades\DB;
use App\Providers\SMSServiceProvider;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'verification_code', 'is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        User::created(function($user) {
            if($user->is_verified){
                DB::table('password_resets')->insert([
                    'email' => $user->email,
                    'mobile' => $user->mobile,
                    'token' => Str::random(10),
                ]);
        
                $tokenData = DB::table('password_resets')->where('mobile', $user->mobile)->first();
                $token = $tokenData->token;
                $mobile = $tokenData->mobile;
                $email = $tokenData->email;
        
                $user = User::where('mobile', $mobile)->first();
                $link = url('password/reset'. $token).'?email='.$email;
        
                // cuttly api for making short link 
                $shortlink = CUTTLYFacade::getShortLink($link);
                
                //generating sms which will carry password reset link
                    $sms = new \App\Sms();
                    $sms->user_id = $user->id;
                    $sms->to = $mobile;
                    $sms->body = "your Fish Farm account has been created. Visit this link to set your password. {$shortlink}";
                    $sms->save(); 
            } else {
                $sms = new \App\Sms();
                $sms->user_id = $user->id;
                $sms->to = $user->mobile;
                $sms->body = "Your Fish Farm Verification Code is: {$user->verification_code}.";
                $sms->save();
            }

        });
        User::updated(function($user) {
            if($user->is_verified != 1) {
            $sms = new \App\Sms();
            $sms->user_id = $user->id;
            $sms->to = $user->mobile;
            $sms->body = "Your Fish Farm Verification Code is: {$user->verification_code}.";
            $sms->save();
            }
        });

    }

    /**
     * Get the cartItems for the user.
     */
    public function cartItems()
    {
        return $this->hasMany('App\CartItem');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }
}
