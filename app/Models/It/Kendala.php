<?php

namespace App\Models\It;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendala extends Model
{
    use HasFactory;

    protected $table = 'kendala';
    protected $primaryKey = 'id_kendala';
    protected $guarded = [
        'id_kendala',
    ];
}
