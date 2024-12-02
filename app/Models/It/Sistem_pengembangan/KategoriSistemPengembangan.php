<?php

namespace App\Models\It\Sistem_pengembangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSistemPengembangan extends Model
{
    use HasFactory;

    protected $table = 'kategori_sistem_pengembangan';
    protected $primaryKey = 'id_kategori_sistem_pengembangan';
    protected $fillable = [
        'judul', 'deskripsi', 'dokumentasi_db',
    ];
}
