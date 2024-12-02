@php
    if (! function_exists('tanggal_indonesia')) {
        function tanggal_indonesia($tgl, $tampil_hari = true) {
            $nama_hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu');
            $nama_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
            $tahun = substr($tgl, 0, 4);
            $bulan = $nama_bulan[(int) substr($tgl, 5, 2)];
            $tanggal = substr($tgl, 8, 2);
            $text = '';
            if ($tampil_hari){
                $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
                $hari = $nama_hari[$urutan_hari];
                $text .= "$hari, $tanggal $bulan $tahun";
            } else {
                $text .= "$tanggal $bulan $tahun";
            }
            return $text;
        }
    }
@endphp


<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- @can('view-role')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('roles') }}" class="nav-link">Roles</a>
            </li>
        @endcan

        @can('view-permission')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('permission') }}" class="nav-link">Permissions</a>
            </li>
        @endcan
        
        @can('view-users')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('users') }}" class="nav-link">Users</a>
            </li>
        @endcan --}}
        
        
    </ul>


    <ul class="nav navbar-nav ml-auto">
        {{-- <li class="nav-item mt-1">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item mt-1">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
            <a href="#" class="" data-toggle="dropdown">
                <img src="{{ asset('storage/management_user/foto_profil/'.auth()->user()->foto)}}" class="user-image mt-1" alt="User Image">
                <span class="text-white">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu bg-dark">
                <!-- User image -->
                <li class="user-header">
                    <img src="{{ asset('storage/management_user/foto_profil/'.auth()->user()->foto)}}" class="img-circle" alt="User Image">

                    <p>
                        {{ auth()->user()->email }}
                        <small>Daftar sejak : {{ tanggal_indonesia(auth()->user()->created_at) }}</small>
                    </p>

                </li>
                <li class="user-footer text-center">
                    <div class="row align-items-start">
                        <div class="col"><a href="{{ route('layouts.profil') }}" class="btn btn-primary">Profil</a></div>
                        <div class="col"><a onclick="document.getElementById('logout-form').submit()" class="btn btn-danger">Keluar</a></div>
                    </div>

                </li>
            </ul>
        </li>

    </ul>
</nav>

<form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
    @csrf
</form>