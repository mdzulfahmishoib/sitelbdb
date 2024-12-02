<?php

namespace App\Models\It\Maintenance\Maintenance_software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceSoftware extends Model
{
    use HasFactory;

    protected $table = 'maintenance_software';
    protected $primaryKey = 'id_maintenance_software';
    protected $fillable = [
        'tanggal_maintenance_software', 'id_kategori_maintenance_software', 'kondisi_maintenance_software', 'keterangan_maintenance_software', 'id_kantor', 'dicek_oleh', 'keterangan_tambahan_maintenance_software', 'dokumentasi_db',
    ];
}
