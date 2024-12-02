<?php

namespace App\Models\Produk_perusahaan\Mobile_banking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProdukMobileBanking extends Model
{
    use HasFactory;

    protected $table = 'kategori_produk_mobile_banking';
    protected $primaryKey = 'id_kategori_produk_mobile_banking';
    protected $guarded = [
        'id_kategori_produk_mobile_banking',
    ];
}
