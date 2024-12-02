<?php

namespace App\Models\It\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengecekanSuhu extends Model
{
    use HasFactory;

    protected $table = 'pengecekan_suhu';
    protected $primaryKey = 'id_pengecekan_suhu';
    protected $fillable = [
        'tanggal_pengecekan_suhu', 'suhu_pagi', 'kondisi_pagi', 'keterangan_tambahan_pagi', 'dicek_oleh', 'suhu_sore', 'kondisi_sore', 'kesimpulan', 'keterangan_tambahan_sore', 'dokumentasi_db'
    ];
}
