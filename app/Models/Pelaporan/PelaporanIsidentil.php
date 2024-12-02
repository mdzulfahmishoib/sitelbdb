<?php

namespace App\Models\Pelaporan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanIsidentil extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_isidentil';
    protected $primaryKey = 'id_pelaporan_isidentil';
    protected $fillable = [
        'tanggal_input_data',
        'jenis_pelaporan',
        'pihak_menerima',
        'perihal_laporan',
        'dokumen_pendukung',
    ];
}
