<?php

namespace App\Models\Pelaporan\Pelaporan_regulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanPemkab extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_pemkab';
    protected $primaryKey = 'id_pelaporan_pemkab';
    protected $guarded = [
        'id_pelaporan_pemkab',
    ];
}
