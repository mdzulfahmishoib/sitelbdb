<?php

namespace App\Models\Produk_perusahaan\Kredit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProdukKredit extends Model
{
    use HasFactory;

    protected $table = 'kategori_produk_kredit';
    protected $primaryKey = 'id_kategori_produk_kredit';
    protected $guarded = [
        'id_kategori_produk_kredit',
    ];
}
