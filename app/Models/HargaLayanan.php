<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaLayanan extends Model
{
    protected $table = 'harga_layanans';
    protected $primaryKey = 'id_layanan';

    protected $fillable = [
        'harga_per_kg'
    ];

     // jenis layanan fixed (tidak boleh ditambah)
    public const DEFAULT_JENIS = [
        'Satuan',
        'Regular',
        'Express',
        'Super Express/Kilat',
    ];

    protected static function boot()
    {
        parent::boot();

        // Melarang perubahan kolom jenis_layanan
        static::updating(function ($data) {
            if (
                $data->isDirty('jenis_layanan') &&
                $data->jenis_layanan !== $data->getOriginal('jenis_layanan')
            ) {
                throw new \Exception("Jenis layanan tidak boleh diubah.");
            }
        });
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_layanan');
    }
}
