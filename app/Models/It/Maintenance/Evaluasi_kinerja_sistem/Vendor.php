<?php

namespace App\Models\It\Maintenance\Evaluasi_kinerja_sistem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendor';
    protected $primaryKey = 'id_vendor';
    protected $fillable = [
        'nama_vendor', 'deskripsi', 
    ];
}
