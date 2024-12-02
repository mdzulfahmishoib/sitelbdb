<?php

namespace App\Models\It\Maintenance\Maintenance_hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceHardware extends Model
{
    use HasFactory;

    protected $table = 'maintenance_hardware';
    protected $primaryKey = 'id_maintenance_hardware';
    protected $fillable = [
        'tanggal_maintenance_hardware', 'id_kategori_maintenance_hardware', 'kondisi_maintenance_hardware', 'keterangan_maintenance_hardware', 'id_kantor', 'dicek_oleh', 'keterangan_tambahan_maintenance_hardware', 'dokumentasi_db',
    ];
}
