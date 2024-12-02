<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('beranda') }}" class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SITEL BDB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar mt-1">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image mt-3">
                <img src="{{ asset('storage/management_user/foto_profil/'.auth()->user()->foto)}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block mb-1" href="{{ route('layouts.profil') }}">Halo, {{ auth()->user()->name }}</a>
                @php
                    $currentUser = auth()->user(); // Ambil user yang sedang login
                @endphp

                <span>
                    @if ($currentUser->getRoleNames() && $currentUser->getRoleNames()->isNotEmpty())
                        @foreach ($currentUser->getRoleNames() as $rolename)
                            <span class="badge bg-success d-inline font-weight-normal text-xs">{{ $rolename }}</span>
                        @endforeach
                    @endif
                </span>
 
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('beranda') }}" class="nav-link {{ request()->is('beranda') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('it/maintenance/backup*') || request()->is('it/maintenance/maintenance_hardware*') || request()->is('it/maintenance/evaluasi_kinerja_sistem*') || request()->is('it/sistem_pengembangan*') || request()->is('it/maintenance/pengecekan_unit_bagian*') || request()->is('it/maintenance/maintenance_software*') || request()->is('it/rekomendasi*') || request()->is('it/maintenance/maintenance_server*') || request()->is('it/maintenance/pengecekan_suhu*') || request()->is('it/maintenance/register_ruang_server*') || request()->is('it/kendala*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>
                            IT
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view_sistem_pengembangan')
                            <li class="nav-item">
                                <a href="{{ route('sistem_pengembangan.index') }}" class="nav-link {{ request()->is('it/sistem_pengembangan*') ? 'active' : '' }}">
                                    <i class="fas fa-server nav-icon"></i>
                                    <p>Sistem & Pengembangan</p>
                                </a>
                            </li>    
                        @endcan
                        
                        <li class="nav-item has-treeview {{ request()->is('it/maintenance/backup*') || request()->is('it/maintenance/maintenance_hardware*') || request()->is('it/maintenance/maintenance_software*') || request()->is('it/maintenance/pengecekan_unit_bagian*') || request()->is('it/maintenance/evaluasi_kinerja_sistem*') || request()->is('it/maintenance/maintenance_server*') || request()->is('it/maintenance/pengecekan_suhu*') || request()->is('it/maintenance/register_ruang_server*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('it/maintenance/backup*') || request()->is('it/maintenance/maintenance_hardware*') || request()->is('it/maintenance/maintenance_software*') || request()->is('it/maintenance/pengecekan_unit_bagian*') || request()->is('it/maintenance/evaluasi_kinerja_sistem*') || request()->is('it/maintenance/maintenance_server*') || request()->is('it/maintenance/pengecekan_suhu*') || request()->is('it/maintenance/register_ruang_server*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>
                                    Maintenance
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('view_pengecekan_unit_bagian')
                                    <li class="nav-item">
                                        <a href="{{ route('pengecekan_unit_bagian.index') }}" class="nav-link {{ request()->routeIs('pengecekan_unit_bagian.index') ? 'active' : '' }}">
                                            <i class="fas fa-network-wired nav-icon"></i>
                                            <p>Perangkat Per Unit/Bagian</p>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('view_maintenance_hardware')
                                <li class="nav-item">
                                    <a href="{{ route('maintenance_hardware.index') }}" class="nav-link {{ request()->routeIs('maintenance_hardware.index') ? 'active' : '' }}">
                                        <i class="fas fa-laptop-medical nav-icon"></i>
                                        <p>Maintenance Hardware</p>
                                    </a>
                                </li>
                                @endcan
                                @can('view_maintenance_software')
                                <li class="nav-item">
                                    <a href="{{ route('maintenance_software.index') }}" class="nav-link {{ request()->routeIs('maintenance_software.index') ? 'active' : '' }}">
                                        <i class="fas fa-window-restore nav-icon"></i>
                                        <p>Maintenance Software</p>
                                    </a>
                                </li>    
                                @endcan
                                @can('view_maintenance_server')
                                <li class="nav-item">
                                    <a href="{{ route('maintenance_server.index') }}" class="nav-link {{ request()->routeIs('maintenance_server.index') ? 'active' : '' }}">
                                        <i class="fas fa-server nav-icon"></i>
                                        <p>Maintenance Server</p>
                                    </a>
                                </li>    
                                @endcan
                                @can('view_pengecekan_suhu')
                                <li class="nav-item">
                                    <a href="{{ route('pengecekan_suhu.index') }}" class="nav-link {{ request()->routeIs('pengecekan_suhu.index') ? 'active' : '' }}">
                                        <i class="fas fa-thermometer-half nav-icon"></i>
                                        <p>Pengecekan Suhu Server</p>
                                    </a>
                                </li>    
                                @endcan
                                
                                @can('view_backup')
                                    <li class="nav-item">
                                        <a href="{{ route('backup.index') }}" class="nav-link {{ request()->routeIs('backup.index') ? 'active' : '' }}">
                                            <i class="fas fa-download nav-icon"></i>
                                            <p>Backup</p>
                                        </a>
                                    </li>
                                @endcan

                                @can('view_evaluasi_kinerja_sistem')
                                    <li class="nav-item">
                                        <a href="{{ route('evaluasi_kinerja_sistem.index') }}" class="nav-link {{ request()->routeIs('evaluasi_kinerja_sistem.index') ? 'active' : '' }}">
                                            <i class="fas fa-laptop-code nav-icon"></i>
                                            <p>Evaluasi Kinerja Sistem</p>
                                        </a>
                                    </li>                                    
                                @endcan

                                @can('view_register_ruang_server')
                                    <li class="nav-item">
                                        <a href="{{ route('register_ruang_server.index') }}" class="nav-link {{ request()->routeIs('register_ruang_server.index') ? 'active' : '' }}">
                                            <i class="fas fa-stream nav-icon"></i>
                                            <p>Register Ruang Server</p>
                                        </a>
                                    </li>    
                                @endcan
                                
                            </ul>
                        </li>
                        @can('view_kendala')
                        <li class="nav-item">
                            <a href="{{ route('kendala.index') }}" class="nav-link {{ request()->is('it/kendala*') ? 'active' : '' }}">
                                <i class="fas fa-tools nav-icon"></i>
                                <p>Kendala/Problem</p>
                            </a>
                        </li>
                        @endcan

                        @can('view_rekomendasi')
                            <li class="nav-item">
                                <a href="{{ route('rekomendasi.index') }}" class="nav-link {{ request()->is('it/rekomendasi*') ? 'active' : '' }}">
                                    <i class="fas fa-vote-yea nav-icon"></i>
                                    <p>Rekomendasi</p>
                                </a>
                            </li>    
                        @endcan
                        
                    </ul>
                </li>                
                <li class="nav-item {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_bpjs*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_dirjen_pajak*') || request()->is('pelaporan/pelaporan_keuangan*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_ppatk*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_lps*')  || request()->is('pelaporan/pelaporan_regulasi/pelaporan_ojk*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_pemkab*') || request()->is('pelaporan/pelaporan_isidentil*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>
                            Pelaporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view_pelaporan_keuangan')
                            <li class="nav-item">
                                <a href="{{ route('pelaporan_keuangan.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_keuangan*') ? 'active' : '' }}">
                                    <i class="fas fa-receipt nav-icon"></i>
                                    <p>Pelaporan Keuangan</p>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item has-treeview {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_bpjs*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_dirjen_pajak*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_pemkab*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_ppatk*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_lps*')  || request()->is('pelaporan/pelaporan_regulasi/pelaporan_ojk*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_bpjs*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_dirjen_pajak*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_pemkab*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_ppatk*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_lps*') || request()->is('pelaporan/pelaporan_regulasi/pelaporan_ojk*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Pelaporan Regulasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('view_pelaporan_pemkab')
                                    <li class="nav-item">
                                        <a href="{{ route('pelaporan_pemkab.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_pemkab*') ? 'active' : '' }}">
                                            <i class="fas fa-university nav-icon"></i>
                                            <p>PEMKAB Bojonegoro</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('view_pelaporan_ojk')
                                    <li class="nav-item">
                                        <a href="{{ route('pelaporan_ojk.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_ojk*') ? 'active' : '' }}">
                                            <i class="fas fa-hand-holding-usd nav-icon"></i>
                                            <p>OJK</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('view_pelaporan_lps')
                                    <li class="nav-item">
                                        <a href="{{ route('pelaporan_lps.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_lps*') ? 'active' : '' }}">
                                            <i class="fas fa-comments-dollar nav-icon"></i>
                                            <p>LPS</p>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('view_pelaporan_ppatk')
                                    <li class="nav-item">
                                        <a href="{{ route('pelaporan_ppatk.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_ppatk*') ? 'active' : '' }}">
                                            <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                            <p>PPATK</p>
                                        </a>
                                    </li>     
                                @endcan
                                @can('view_pelaporan_dirjen_pajak')
                                    <li class="nav-item">
                                        <a href="{{ route('pelaporan_dirjen_pajak.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_dirjen_pajak*') ? 'active' : '' }}">
                                            <i class="fas fa-money-check-alt nav-icon"></i>
                                            <p>DIRJEN PAJAK</p>
                                        </a>
                                    </li>    
                                @endcan
                                @can('view_pelaporan_bpjs')
                                    <li class="nav-item">
                                        <a href="{{ route('pelaporan_bpjs.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_bpjs*') ? 'active' : '' }}">
                                            <i class="fas fa-hospital nav-icon"></i>
                                            <p>BPJS</p>
                                        </a>
                                    </li>    
                                @endcan
                                @can('view_pelaporan_dukcapil_perbarindo')
                                    <li class="nav-item">
                                        <a href="{{ route('pelaporan_dukcapil_perbarindo.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo*') ? 'active' : '' }}">
                                            <i class="fas fa-briefcase nav-icon"></i>
                                            <p>DUKCAPIL X PERBARINDO</p>
                                        </a>
                                    </li>    
                                @endcan
                                
                            </ul>
                        </li>
                        @can('view_pelaporan_isidentil')
                            <li class="nav-item">
                                <a href="{{ route('pelaporan_isidentil.index') }}" class="nav-link {{ request()->is('pelaporan/pelaporan_isidentil*') ? 'active' : '' }}">
                                    <i class="fas fa-file-medical-alt nav-icon"></i>
                                    <p>Pelaporan Isidentil</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('produk_perusahaan/produk_mobile_banking*') || request()->is('produk_perusahaan/produk_dana*') || request()->is('produk_perusahaan/produk_kredit*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Produk Perusahaan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view_kategori_produk_kredit')
                            <li class="nav-item">
                                <a href="{{ route('produk_kredit.index') }}" class="nav-link {{ request()->is('produk_perusahaan/produk_kredit*') ? 'active' : '' }}">
                                    <i class="fas fa-credit-card nav-icon"></i>
                                    <p>Kredit</p>
                                </a>
                            </li>    
                        @endcan
                        @can('view_kategori_produk_dana')
                            <li class="nav-item">
                                <a href="{{ route('produk_dana.index') }}" class="nav-link {{ request()->is('produk_perusahaan/produk_dana*') ? 'active' : '' }}">
                                    <i class="fas fa-money-bill-wave nav-icon"></i>
                                    <p>Dana</p>
                                </a>
                            </li>    
                        @endcan
                        @can('view_kategori_produk_mobile_banking')
                            <li class="nav-item">
                                <a href="{{ route('produk_mobile_banking.index') }}" class="nav-link {{ request()->is('produk_perusahaan/produk_mobile_banking*') ? 'active' : '' }}">
                                    <i class="fas fa-mobile nav-icon"></i>
                                    <p>Mobile Banking</p>
                                </a>
                            </li>    
                        @endcan
                        
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->routeIs('informasi.contact_person') || request()->routeIs('informasi.tentang_sitelbdb') || request()->is('contact*') || request()->is('informasi/kantor*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            Informasi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('informasi.tentang_sitelbdb') }}" class="nav-link {{ request()->routeIs('informasi.tentang_sitelbdb') ? 'active' : '' }}">
                                <i class="fas fa-info nav-icon"></i>
                                <p>Tentang SITEL</p>
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a href="{{ route('informasi.contact_person') }}" class="nav-link {{ request()->routeIs('informasi.contact_person') ? 'active' : '' }}">
                                <i class="fas fa-phone-alt nav-icon"></i>
                                <p>Contact Person</p>
                            </a>
                        </li>
                        @can('view_kantor')
                        <li class="nav-item">
                            <a href="{{ route('kantor.index') }}" class="nav-link {{ request()->routeIs('kantor.index') ? 'active' : '' }}">
                                <i class="fas fa-home nav-icon"></i>
                                <p>Kantor</p>
                            </a>
                        </li>    
                        @endcan
                        
                    </ul>
                </li>
                @can('view_management_user')
                <li class="nav-item has-treeview {{ request()->is('management_user/roles*') || request()->is('management_user/permission*') || request()->is('management_user/users*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Management User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('management_user/roles') ? 'active' : '' }}">
                                <i class="fas fa-user-check nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permission.index') }}" class="nav-link {{ request()->is('management_user/permission') ? 'active' : '' }}">
                                <i class="fas fa-user-tag nav-icon"></i>
                                <p>Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('management_user/users') ? 'active' : '' }}">
                                <i class="fas fa-users-cog nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
