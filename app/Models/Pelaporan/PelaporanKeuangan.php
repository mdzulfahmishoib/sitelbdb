<?php

namespace App\Models\Pelaporan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'pelaporan_keuangan';
    protected $primaryKey = 'id_pelaporan_keuangan';
    protected $fillable = [
        'tanggal_input_data',
        'periode_tahun',
        'periode_bulan',
        'asset',
        'kredit',
        'penempatan_bank_lain',
        'tabungan',
        'deposito',
        'pendapatan_operasional',
        'pendapatan_non_operasional',
        'biaya_operasional',
        'biaya_non_operasional',
        'laba_sebelum_pajak',
        'pajak',
        'laba_setelah_pajak',
        'kap',
        'kpmm',
        'npl',
        'ppap',
        'ldr',
        'roa',
        'roe',
        'bopo',
        'nim',
        'cr',
        'posisi_keuangan',
        'laba_rugi',
        'kualitas_aset_produktif',
    ];
}
