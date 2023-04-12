<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Mail;
use Illuminate\Support\Str;


class MailController extends Controller
{
     //SendEmail

     public function testSend(){
        return "testing";
     }

     public function sendVerificationCode(Request $request)
     {
         $data = array('name' => 'Music App Verification');
         $user = Auth::user();
         $code = Str::random(6);
         Mail::raw("welcome to verification center $code is your code",function ($m) use($user)  {
             $m->from('fathimahafsa97101@outlook.com', 'Music App Verification')
             ->to($user->email, $user->name)->subject('Verification Message!');
         });
             return response(['code'=>1, 'message'=> 'Email has been sent', 'verification_code'=>$code]);
     
     }   

}
