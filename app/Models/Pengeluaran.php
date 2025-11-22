<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';
    protected $primaryKey = 'id_pengeluaran';

    // Laravel  otomatis mengelola created_at dan updated_at
    public $timestamps = true;
    
    protected $fillable = [
        'id_user',
        'nominal',
        'kategori',
        'metode_pembayaran',
        'penerima',
        'keterangan',
        'tanggal',
        'bukti_pengeluaran',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
