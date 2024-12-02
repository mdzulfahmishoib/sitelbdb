@extends('layouts.master')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Informasi</li>
    <li class="breadcrumb-item active">Contact Person</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="text-center">CONTACT PERSON</h3><br>
                    <p style="text-align: justify">Sebagai nara hubung atau Tim IT dan Pelaporan siap membantu Anda dalam menjawab pertanyaan, memberikan informasi tambahan dan membantu mengatasi masalah atau kendala, melalui :</p>
                    
                    <ol>
                        <a class="mx-3 text-md text-success" href="https://wa.me/628113045050" dir="ltr"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                        <a class="mx-3 text-md text-dark" href="https://bankdaerahbojonegoro.com" dir="ltr"><i class="fas fa-globe-americas"></i> Website</a>
                        <a class="mx-3 text-md text-info" href="mailto:bankdaerahbojonegoro@gmail.com" dir="ltr"><i class="fas fa-envelope"></i> Email</a>
                    </ol>

                    <p style="text-align: justify">Ikuti kami di berbagai platform media sosial seperti Facebook, Instagram dan Youtube untuk mendapatkan akses langsung ke konten-konten menarik seperti promosi eksklusif dan informasi lainnya, berikut link media sosial kami :</p>

                    <ol>
                        <a class="mx-3 text-md" href="https://www.facebook.com/bdbbojonegoro/" dir="ltr"><i class="fab fa-facebook"></i> Facebook</a>
                        <a class="mx-3 text-md text-danger" href="https://www.instagram.com/bprbojonegoro/" dir="ltr"><i class="fab fa-instagram"></i> Instagram</a>
                        <a class="mx-3 text-md text-danger" href="https://www.youtube.com/@bankdaerahbojonegoro7825" dir="ltr"><i class="fab fa-youtube"></i> Youtube</a>
                    </ol>

                </div>
                <div class="col">
                      <img width="100%" src="{{ asset('img\illustration_header.png') }}" alt="">
                </div>
            </div>
            
            <br>
            
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->


</section>

@endsection
