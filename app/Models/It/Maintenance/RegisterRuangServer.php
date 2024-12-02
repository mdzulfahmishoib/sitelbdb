<?php

namespace App\Models\It\Maintenance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterRuangServer extends Model
{
    use HasFactory;

    protected $table = 'register_ruang_server';
    protected $primaryKey = 'id_register_ruang_server';
    protected $fillable = [
        'tanggal_register_ruang_server', 'nama_petugas', 'keperluan', 'kategori_urgensi', 'pihak', 'bagian_instansi', 'keterangan_tambahan', 'dokumentasi_db'
    ];
}
