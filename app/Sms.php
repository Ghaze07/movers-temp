<?php

namespace App;

use App\Facades\SMSFacade;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected static function boot()
    {
        parent::boot();
        Sms::created(function($sms) {
            $response = SMSFacade::sendSMS($sms->to, $sms->body);
            $sms->status = isset( $response->status ) ? $response->status : "Failed";
            if( isset($response->MessageID) ) {
                $sms->message_id = $response->MessageID;
                $sms->sms_parts = $response->BillingLog->SMS_Parts;
                $sms->credit_deducted = $response->BillingLog->Credit_Deducted;
            }
            $sms->save();
        });
    }
}
