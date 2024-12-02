<?php

namespace App\Models\Pelaporan\Pelaporan_regulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanBpjs extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_bpjs';
    protected $primaryKey = 'id_pelaporan_bpjs';
    protected $guarded = [
        'id_pelaporan_bpjs',
    ];
}
