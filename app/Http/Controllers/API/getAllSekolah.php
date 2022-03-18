<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sekolah;

class getAllSekolah extends Controller
{
    public function index(){
         $sekolahs = Sekolah::select('id','nama')->get();

         return response()->json(
              [
                   'status'=>'success',
                   'data'=> $sekolahs
              ], 200
         );
    }
}
