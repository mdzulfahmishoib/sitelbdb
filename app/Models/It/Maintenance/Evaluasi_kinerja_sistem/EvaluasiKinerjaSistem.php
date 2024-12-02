<?php

namespace App\Models\It\Maintenance\Evaluasi_kinerja_sistem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiKinerjaSistem extends Model
{
    use HasFactory;

    protected $table = 'evaluasi_kinerja_sistem';
    protected $primaryKey = 'id_evaluasi_kinerja_sistem';
    protected $fillable = [
        'tanggal_evaluasi_kinerja_sistem', 
        'id_vendor', 
        'kepatuhan_kontrak', 
        'keandalan_kualitas_layanan',
        'ketepatan_waktu_pelayanan',
        'responsif_keluhan',
        'kepuasan_layanan',
        'standar_kualitas',
        'sumber_daya_kualitas',
        'proses_pengujian_pengendalian_kualitas',
        'kualitas_laporan',
        'ketersediaan_layanan',
        'tingkat_kegagalan',
        'waktu_pemulihan',
        'kepatuhan_standar_bpr',
        'kepatuhan_persyaratan',
        'kepatuhan_kode_etik',
        'kepatuhan_bcp',
        'kemudahan_berkomunikasi',
        'tingkat_kerjasama',
        'tingkat_keterbukaan',
        'kemampuan_solusi',
        'kontribusi_layanan',
        'dokumentasi_db',
    ];
}
