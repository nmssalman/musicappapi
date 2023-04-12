<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Mail;
use Illuminate\Support\Str;





class UserController extends Controller {
    public function RegisterUser(Request $request)
    {
        $input = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'nickname' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        if (User::where('email', '=', $request->get('email'))->count() > 0) {
            return response(['code' => 1002, 'message' => 'Email already registered'], 400);
        } else  if (User::where('phone_number', '=', $request->get('phone_number'))->count() > 0) {
            return response(['code' => 1003, 'message' => 'Phone Number already registered'], 400);
        } else  if (User::where('nickname', '=', $request->get('nickname'))->count() > 0) {
            return response(['code' => 1004, 'message' => 'Nickname already registered'], 400);
        } else {
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $successs['token'] = $user->createToken('MyApp')->accessToken;
            $successs['name'] = $user->name;
            return response(['code' => 1, 'token' => $successs, 'data' => $user], 200);
        }
    }

    public function LoginUser(Request $request)
    {
        
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($login)) {
            return response(['Code' => 1001, 'message' => 'Invalid User Authentications'], 400);
        }
        $accessToken = Auth::user()->createToken('Personal')->accessToken; 
        return response(['Code' => 1, 'token' => $accessToken, 'user' => Auth::user()], 200);

    }

    public function DeleteUser(Request $request)
    {
        $user = User::where('email', '=', $request->get('email'));
        if ($user->count() > 0) {
            $user->delete();
            return response(['code' => 1, 'message' => 'User Deleted Successfully'], 200);
        } else {
            return response(['code' => 0, 'message' => 'User Not Found! Invalid Email address'], 400);
        }
        }

    public function UpdateUserInfo(Request $request)
    {
        $user = User::where('email', '=', $request->get('email'));
        if ($user->count() > 0) {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'dob' => $request->dob,
                'gender' => $request->gender,

            ]);
            return response(['code' => 1, 'message' => 'User has been successfully updated'], 200);
        } else {
            return response(['code' => 0, 'message' => 'User Not Found!'], 400);
        }
    }

    public function GetAllUsers(Request $request)
    {
        $users = User::all();
        return response(['code' => 1, 'data'=>$users], 200);
    } 

    public function IsEmailVerified()
        {
        
            $user = Auth::user();
           if($user->email_verified == 1) 
            {
                return response(['code'=>1, 'is_verified'=>true]);
            }
            return response(['code'=>1, 'is_verified'=>false]);
               
        }

    
    public function IsPhoneVerified()
        {
        
            $user = Auth::user();
           
            if($user->phone_verified == '1')
            {
                return response(['code'=>1, 'is_verified'=>true]);
            }
            return response(['code'=>1, 'is_verified'=>false]);
               
        }

        //VerifyEmail
      
        public function verifyEmail()
        {

         $user = Auth::user();
           // return $user;
         $user->email_verified = 1;
         $user->save();
             
         return response(['code' => 1, 'message' => 'Email has been verified.'], 200);
       
            
       }
        
        //VerifyPhone

        public function VerifyPhone()
        {
            $user = Auth::user();
           // return $user;
         $user->phone_verified = '1';
        $user->save();
        
            return response(['code' => 1, 'message' => 'Phone number has been verified'], 200);   
               
        }

       
    } 

        
