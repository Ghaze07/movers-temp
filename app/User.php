<?php

namespace App;

use App\Facades\SMS;
use App\Facades\SMSFacade;
use App\Providers\SMSServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'verification_code'
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
            $sms->body = "Your Fish Farm Verification Code is: {$user->verification_code}.";
            $sms->save();
        });
    }

    /**
     * Get the cartItems for the user.
     */
    public function cartItems()
    {
        return $this->hasMany('App\CartItem');
    }
}
