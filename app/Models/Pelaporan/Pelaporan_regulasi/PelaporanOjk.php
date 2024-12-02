<?php

namespace App\Models\Pelaporan\Pelaporan_regulasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelaporanOjk extends Model
{
    use HasFactory;
    protected $table = 'pelaporan_ojk';
    protected $primaryKey = 'id_pelaporan_ojk';
    protected $guarded = [
        'id_pelaporan_ojk',
    ];
}
