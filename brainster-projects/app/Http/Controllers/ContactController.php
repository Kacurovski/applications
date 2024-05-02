<?php

namespace App\Http\Controllers;

use App\Mail\MailTrap;
use App\Mail\MailChimp;
use Illuminate\Http\Request;
use App\Http\Requests\MailRequest;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submitForm(MailRequest $request) 
    {       
        $email = $request->input('email');
        $phone = $request->input('phone');
        $company = $request->input('company');

        Mail::to(config('mail.from.address'))->send(new MailTrap($email, $phone, $company));

        return redirect()->back()->with('success', 'Thank You!');

    }
}
