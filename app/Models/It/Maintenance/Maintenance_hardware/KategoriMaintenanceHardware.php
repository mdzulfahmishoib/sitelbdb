<?php

namespace App\Models\It\Maintenance\Maintenance_hardware;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMaintenanceHardware extends Model
{
    use HasFactory;

    protected $table = 'kategori_maintenance_hardware';
    protected $primaryKey = 'id_kategori_maintenance_hardware';
    protected $fillable = [
        'kategori_maintenance_hardware'
    ];
}
