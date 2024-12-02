<?php

namespace App\Models\It\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengecekanUnitBagian extends Model
{
    use HasFactory;

    protected $table = 'pengecekan_unit_bagian';
    protected $primaryKey = 'id_pengecekan_unit_bagian';
    protected $fillable = [
        'tanggal_pengecekan_unit_bagian', 
        'id_kantor', 
        'id_unit_bagian', 
        'komputer_laptop',
        'printer',
        'scan',
        'jaringan',
        'mesin_hitung',
        'windows',
        'microsoft_office',
        'antivirus',
        'browser',
        'cbs',
        'cek_ktp',
        'dvr_mikrotik',
        'keterangan_tambahan',
        'dokumentasi_db',
    ];
}
