@extends('layouts.master')

@section('title')
    Produk Dana
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Produk Perusahaan</li>
    <li class="breadcrumb-item active">Produk Dana</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
          @can('kategori_produk_dana')
              <a href="{{ route('kategori_produk_dana.index') }}" class="btn btn-primary mb-3"><i class="fa fa-list"></i> Tambah Kategori</a>  
          @endcan

          <table class="table table-responsive">
            @foreach ($kategori_produk_dana as $index => $data_kategori_produk_dana)
                <tbody class="border-bottom">
                  <tr>
                    <td><h4>{{ $index + 1 }}. {{ $data_kategori_produk_dana->judul }}</h4><p class="text-justify">{{ $data_kategori_produk_dana->deskripsi }}</p></td>
                    <td><img src="{{ asset('storage/produk_perusahaan/dana/kategori_produk_dana/' . $data_kategori_produk_dana->dokumentasi_db) }}" width="200" class="ml-3 rounded-lg" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal('{{ $data_kategori_produk_dana->dokumentasi }}')"/></td>
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
