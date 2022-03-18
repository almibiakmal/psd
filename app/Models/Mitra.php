<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    protected $fillable = [
          'brand',
          'nama_pengelola',
          'nama_perusahaan',
          'email',
          'handphone',
          'alamat',
          'saldo',
          'server',
          'webhook',
          'token',
          'status',
          'created_at',
          'updated_at'
    ];
}
