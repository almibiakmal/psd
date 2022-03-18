<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
     'pengguna',
     'tipe_pengguna',
     'kategori',
     'jumlah',
     'saldo_awal',
     'saldo_akhir',
     'reference',
     'created_at',
     'updated_at'
    ];
}
