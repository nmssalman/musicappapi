<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;



class TrackController extends Controller
{
    //insert records
    
    public function InsertRecords(Request $request) {
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

    // retrieve data
      
    public function RetrieveData(Request $request)

    {
        $songs = Song::all();
        return response(['code' => 1, 'data'=>$songs], 200);

    } 

}



