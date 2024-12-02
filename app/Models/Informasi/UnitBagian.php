<?php

namespace App\Models\Informasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitBagian extends Model
{
    use HasFactory;

    protected $table = 'unit_bagian';
    protected $primaryKey = 'id_unit_bagian';
    protected $fillable = [
        'nama_unit_bagian', 
    ];
}
