<?php

namespace App\Models\It\Maintenance\Backup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBackup extends Model
{
    use HasFactory;

    protected $table = 'kategori_backup';
    protected $primaryKey = 'id_kategori_backup';
    protected $fillable = [
        'kategori_backup', 
    ];
}
