<?php

namespace App\Models\It\Maintenance\Maintenance_server;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceServer extends Model
{
    use HasFactory;

    protected $table = 'maintenance_server';
    protected $primaryKey = 'id_maintenance_server';
    protected $fillable = [
        'tanggal_maintenance_server', 'id_kategori_maintenance_server', 'kondisi_maintenance_server', 'keterangan_maintenance_server', 'id_kantor', 'dicek_oleh', 'keterangan_tambahan_maintenance_server', 'dokumentasi_db',
    ];
}
