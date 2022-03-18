<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tagihan;

class checkTagihan extends Controller
{
    public function index($idSekolah, $nis){

          $tagihans = Tagihan::join('sekolahs','tagihans.sekolah_id', '=', 'sekolahs.id')
          ->where([
               ['tagihans.sekolah_id','=', $idSekolah],
               ['tagihans.nis','=',$nis],
               ['tagihans.status','=','1'],
          ])
          ->get([
               'tagihans.id','tagihans.nis','tagihans.nama','tagihans.biaya AS total','tagihans.title AS deskripsi','sekolahs.nama AS sekolah'
          ]);

          if($tagihans->isEmpty()){
               return response()->json(
                    [
                         'status'=>'success',
                         'data'=> [],
                         'message'=>'Data not found'
                    ], 200
               );
          }else{
               return response()->json(
                    [
                         'status'=>'success',
                         'data'=> $tagihans
                    ], 200
               );
          }

          
    }
}
