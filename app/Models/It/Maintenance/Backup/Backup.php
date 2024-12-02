<?php

namespace App\Models\It\Maintenance\Backup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $table = 'backup';
    protected $primaryKey = 'id_backup';
    protected $fillable = [
        'id_kategori_backup', 'tanggal_backup', 'metode_backup', 'jenis_backup', 'waktu_backup', 'nama_file_backup', 'nama_petugas_backup', 'validasi_backup', 'nama_petugas_validasi', 'keterangan_backup', 
    ];
}
