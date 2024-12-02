<?php

namespace App\Models\It\Maintenance\Maintenance_software;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriMaintenanceSoftware extends Model
{
    use HasFactory;

    protected $table = 'kategori_maintenance_software';
    protected $primaryKey = 'id_kategori_maintenance_software';
    protected $fillable = [
        'kategori_maintenance_software'
    ];
}
