<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    // Nama tabel sesuai database
    protected $table = 'pesanans';

    // Primary key sesuai database
    protected $primaryKey = 'id_pesanan';

    // Laravel  otomatis mengelola created_at dan updated_at
    public $timestamps = true;

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'id_user',
        'nama_pelanggan',
        'nomor_telephone',
        'barang_laundry',
        'berat_cucian',
        'jenis_layanan',
        'tanggal_pesanan',
        'tanggal_selesai',
        'keterangan',
        'status_pesanan',
        'total_harga',
        'metode_pembayaran',
        'status_pembayaran',
        'tanggal_pembayaran',
    ];

     protected $casts = [
        'tanggal_pesanan' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'tanggal_pembayaran' => 'datetime',
    ];

    // ⬇️ Tambahkan function ini di bawah sini
    public function setTotalHargaAttribute($value)
    {
        if (is_null($value)) {
            $hargaPerKg = match ($this->jenis_layanan) {
                'Regular' => 7000,
                'Express' => 10000,
                'Super Express/Kilat' => 15000,
                default => 7000,
            };

            $this->attributes['total_harga'] = $this->berat_cucian * $hargaPerKg;
        } else {
            $this->attributes['total_harga'] = $value;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
