<?php

namespace App\Models\Produk_perusahaan\Dana;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProdukDana extends Model
{
    use HasFactory;

    protected $table = 'kategori_produk_dana';
    protected $primaryKey = 'id_kategori_produk_dana';
    protected $guarded = [
        'id_kategori_produk_dana',
    ];
}
