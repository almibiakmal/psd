<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayartagihan extends Model
{
    use HasFactory;

    protected $fillable = [
         'mitra_id',
         'tagihan_id',
         'saldo_terpotong',
         'status',
         'created_at',
         'updated_at'
    ];
}
