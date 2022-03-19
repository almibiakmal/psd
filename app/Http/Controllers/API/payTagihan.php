<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Tagihan;
use App\Models\Mitra;
use App\Models\Transaksi;
use App\Models\BayarTagihan;

class payTagihan extends Controller
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

          //get data tagihan
         $tagihan = Tagihan::where([
                         ['id','=', $request->invoice],
                         ['status','=','1']
                    ])->first();//return model or null
                    
         if(empty($tagihan)){
               return response()->json(
                    [
                         'status'=>'success',
                         'data'=> [],
                         'message'=>'Data not found',
                         'code'=>'2'
                    ], 200
               );
         }

         $totalBiaya = $tagihan->biaya + 2000;
         //check balance
         if($mitra->saldo < $totalBiaya){
               return response()->json(
                    [
                         'status'=>'failed',
                         'data'=> [],
                         'message'=>'Balance is not enough',
                         'code'=>'3'
                    ], 200
               );
         }

         $currentTime = Carbon::now('Asia/Jakarta');
         $waktuPelunasan = $currentTime->toDateTimeString();
         $sisaSaldo = $mitra->saldo - $totalBiaya;

         //catat pembayaran tagihan
         $bayarTagihan = Bayartagihan::create([
               'mitra_id' => $mitra->id,
               'tagihan_id' => $tagihan->id,
               'saldo_terpotong' => $totalBiaya,
               'status' => '1',
               'created_at' => $waktuPelunasan,
               'updated_at' => null
          ]);

          //save log to table transaksi
          $transaksi = Transaksi::create([
               'pengguna' => $mitra->id,
               'tipe_pengguna' => 'mitra',
               'kategori' => 'keluar',
               'jumlah' => $totalBiaya,
               'saldo_awal' => $mitra->saldo,
               'saldo_akhir' => $sisaSaldo,
               'reference' => $bayarTagihan->id,
               'created_at' => $waktuPelunasan,
               'updated_at' => null
          ]);

         //update balance mitra
         $mitra->saldo = $sisaSaldo;
         $mitra->updated_at = $waktuPelunasan;
         $mitra->save();

         //update status pembayaran tagihan
         $tagihan->metode_pembayaran = $mitra->brand;
         $tagihan->status = "2";
         $tagihan->waktu_pelunasan = $waktuPelunasan;
         $tagihan->updated_at = $waktuPelunasan;
         $tagihan->save();

         return response()->json(
               [
                    'status'=>'success',
                    'data'=> [],
                    'message'=>'SPP berhasil dibayar',
                    'code'=>'4'
               ], 200
          );
         
    }
}
