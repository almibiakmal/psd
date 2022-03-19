<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Sekolah;
use App\Models\Mitra;

class getAllSekolah extends Controller
{
    public function index(Request $request){

          //get data mitra
         $mitra = Mitra::where([
               ['email','=', $request->header('email')],
               ['token','=',$request->header('api-key')],
               // ['server','=',$_SERVER['REMOTE_ADDR']],s
               ['status','=','2'],
          ])->first(); //return model or null


          if(!$mitra){
               return response()->json(
                    [
                         'status'=>'failed',
                         'data'=> [],
                         'message'=>'Unauthorized',
                         'code'=>'1'
                    ], 401
               );
          }

         $sekolahs = Sekolah::select('id','nama')->get();

         return response()->json(
              [
                   'status'=>'success',
                   'data'=> $sekolahs
              ], 200
         );
    }
}
