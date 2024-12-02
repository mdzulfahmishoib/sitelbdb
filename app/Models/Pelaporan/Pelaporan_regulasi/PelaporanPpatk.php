<?php

namespace App\Models\Pelaporan\Pelaporan_regulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanPpatk extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_ppatk';
    protected $primaryKey = 'id_pelaporan_ppatk';
    protected $guarded = [
        'id_pelaporan_ppatk',
    ];
}
