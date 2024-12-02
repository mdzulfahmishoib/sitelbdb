@extends('layouts.master')

@section('title')
    Produk Mobile Banking
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Produk Perusahaan</li>
    <li class="breadcrumb-item active">Produk Mobile Banking</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
          @can('kategori_produk_mobile_banking')
              <a href="{{ route('kategori_produk_mobile_banking.index') }}" class="btn btn-primary mb-3"><i class="fa fa-list"></i> Tambah Kategori</a>  
          @endcan

          <table class="table table-responsive">
            @foreach ($kategori_produk_mobile_banking as $index => $data_kategori_produk_mobile_banking)
                <tbody class="border-bottom">
                  <tr>
                    <td><h4>{{ $index + 1 }}. {{ $data_kategori_produk_mobile_banking->judul }}</h4><p class="text-justify">{{ $data_kategori_produk_mobile_banking->deskripsi }}</p></td>
                    <td><img src="{{ asset('storage/produk_perusahaan/mobile_banking/kategori_produk_mobile_banking/' . $data_kategori_produk_mobile_banking->dokumentasi_db) }}" width="200" class="ml-3 rounded-lg" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal('{{ $data_kategori_produk_mobile_banking->dokumentasi }}')"/></td>
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
