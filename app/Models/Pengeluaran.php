<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';
    protected $primaryKey = 'id_pengeluaran';

    protected $fillable = [
        'id_user',
        'nominal',
        'kategori',
        'metode_pembayaran',
        'penerima',
        'keterangan',
        'tanggal',
        'bukti_pengeluaran',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    
}
