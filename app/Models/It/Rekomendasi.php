<?php

namespace App\Models\It;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $table = 'rekomendasi';
    protected $primaryKey = 'id_rekomendasi';
    protected $fillable = [
        'id_kantor', 'id_unit_bagian', 'tanggal_pengajuan_rekomendasi', 'nama_pemohon_rekomendasi', 
        'tentang_pengadaan', 'rekomendasi_pembelian', 'status', 
        'tanggal_persetujuan_rekomendasi', 'keterangan_tambahan', 'dokumentasi_db'
    ];
}
