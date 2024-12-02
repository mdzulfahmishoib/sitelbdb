@extends('layouts.master')

@section('title')
    Produk Kredit
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Produk Perusahaan</li>
    <li class="breadcrumb-item active">Produk Kredit</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
          @can('kategori_produk_kredit')
              <a href="{{ route('kategori_produk_kredit.index') }}" class="btn btn-primary mb-3"><i class="fa fa-list"></i> Tambah Kategori</a>  
          @endcan

          <table class="table table-responsive">
            @foreach ($kategori_produk_kredit as $index => $data_kategori_produk_kredit)
                <tbody class="border-bottom">
                  <tr>
                    <td><h4>{{ $index + 1 }}. {{ $data_kategori_produk_kredit->judul }}</h4><p class="text-justify">{{ $data_kategori_produk_kredit->deskripsi }}</p></td>
                    <td><img src="{{ asset('storage/produk_perusahaan/kredit/kategori_produk_kredit/' . $data_kategori_produk_kredit->dokumentasi_db) }}" width="200" class="ml-3 rounded-lg" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal('{{ $data_kategori_produk_kredit->dokumentasi }}')"/></td>
                  </tr>
                </tbody>
            @endforeach
          </table>
          
        </div>      
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
@endsection
