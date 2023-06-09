<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;



class TrackController extends Controller
{
    //create records
    
    public function createASong(Request $request) {
        $input = $request->validate([
            'title'=>'required|string',
            'song_id' => 'required|int',
           'description' =>'required|string',
           'demo_uuid' =>'required|string',
           'song_uuid' =>'required|string',
           'album_id'=>'required|int'
         ]);

    
            $song = Song::create($input);

         return response(['code' => 1, 'message' => 'Records Inserted Successfully'], 200);
    
    }



    //get data

     public function GetData(Request $request)

    {
        $songs = Song::all();
        return response(['code' => 1, 'data'=>$songs], 200);

    } 

}



