<?php

namespace App\Models\Pelaporan\Pelaporan_regulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanDirjenPajak extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_dirjen_pajak';
    protected $primaryKey = 'id_pelaporan_dirjen_pajak';
    protected $guarded = [
        'id_pelaporan_dirjen_pajak',
    ];
}
