<?php

namespace App\Models\It\Maintenance\Maintenance_server;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMaintenanceServer extends Model
{
    use HasFactory;

    protected $table = 'kategori_maintenance_server';
    protected $primaryKey = 'id_kategori_maintenance_server';
    protected $fillable = [
        'kategori_maintenance_server'
    ];
}
