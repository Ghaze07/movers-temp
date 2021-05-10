<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    
    public function submit()
    {
        $data = request()->validate([
            'name' => ['required'],
            'email' => ['required'],
            'message' => ['required'],
        ]);
        Mail::to('admin@smallhaul.com')->send(new ContactFormMail($data));
        
        // return redirect('/');
        return response()->json(['message' => 'we have recieved your message will get back to you shortly.']);
        
    }
}
