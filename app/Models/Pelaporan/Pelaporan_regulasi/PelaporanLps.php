<?php

namespace App\Models\Pelaporan\Pelaporan_regulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanLps extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_lps';
    protected $primaryKey = 'id_pelaporan_lps';
    protected $guarded = [
        'id_pelaporan_lps',
    ];
}
