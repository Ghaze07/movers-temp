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
        'name', 'email', 'password', 'mobile', 'verification_code', 'is_verified', 'role'
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
               $sms = new \App\Sms();
                $sms->user_id = $user->id;
                $sms->to = $user->mobile;
                $sms->body = "Your Verification Code for small haul is: {$user->verification_code}.";
                $sms->save();
        });
        User::updated(function($user) {
            if($user->is_verified != 1) {
            $sms = new \App\Sms();
            $sms->user_id = $user->id;
            $sms->to = $user->mobile;
            $sms->body = "Your Verification Code for small haul is: {$user->verification_code}.";
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
