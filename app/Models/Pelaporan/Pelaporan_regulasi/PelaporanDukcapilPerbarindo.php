<?php

namespace App\Models\Pelaporan\Pelaporan_regulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanDukcapilPerbarindo extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_dukcapil_perbarindo';
    protected $primaryKey = 'id_pelaporan_dukcapil_perbarindo';
    protected $guarded = [
        'id_pelaporan_dukcapil_perbarindo',
    ];
}
