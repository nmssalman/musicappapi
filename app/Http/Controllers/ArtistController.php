<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Artist;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    //RegisterArtist
    public function register(Request $request)
    {
      
        $input= $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'dob' => 'required|date',
            'nickname' => 'required|string',
            'country' => 'required|string',
            'mobile' => 'required|string',
            'image' => 'required|string',
            
        ]);
         
        if (Artist::where('email', '=', $request->get('email'))->count() > 0) {
            return response(['code' => 1002, 'message' => 'Email already registered'], 400);
        } else  if (Artist::where('nickname', '=', $request->get('nickname'))->count() > 0) {
            return response(['code' => 1004, 'message' => 'Nickname already registered'], 400);
        } else {
            $input['password'] = bcrypt($input['password']);
            $user = Artist::create($input);
            $successs['token'] = $user->createToken('MyApp')->accessToken;
            $successs['name'] = $user->name;
            return response(['code' => 1, 'token' => $successs, 'data' => $user], 200);
        }
    }

    //Login Artist

    public function login(Request $request)
    {
        
        $login = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        if (!auth('artists')->attempt($login)) {
            return response(['Code' => 1001, 'message' => 'Invalid User Authentications'], 400);
        }
        $accessToken = Auth::user()->createToken('Personal')->accessToken; 
        return response(['Code' => 1, 'token' => $accessToken, 'user' => Auth::user()], 200);

    }

}

