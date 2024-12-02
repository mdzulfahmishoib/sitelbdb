<?php

namespace App\Models\Informasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;

    protected $table = 'kantor';
    protected $primaryKey = 'id_kantor';
    protected $fillable = [
        'nama_kantor', 'jenis_kantor', 'telepon_kantor', 'email_kantor', 'alamat_kantor' 
    ];
}
