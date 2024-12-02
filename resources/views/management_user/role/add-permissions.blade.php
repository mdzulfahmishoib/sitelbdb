@extends('layouts.master')

@section('title')
    Edit Role Permission
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / Role Management / Edit Role Permission</li>
@endsection

@section('content')

<section class="content">
    <div class="card">
        <div class="card-header">
            <span class="h4"><i class="fa fa-user-check mx-2 text-primary"></i><b class="text-primary">{{ $role->name }}</b></span>
        </div>
        <div class="card-body">
            <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                @csrf
                @method('PUT')
        
                <div class="mb-3">
                    @error('permission')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror   
        
                    <!-- Table for structured layout -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Permission Name</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Create</th>
                                <th class="text-center">Read</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                                <th class="text-center">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>IT > Sistem & Pengembangan</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_sistem_pengembangan" 
                                           {{ in_array('view_sistem_pengembangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_sistem_pengembangan" 
                                           {{ in_array('create_sistem_pengembangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_sistem_pengembangan" 
                                           {{ in_array('read_sistem_pengembangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_sistem_pengembangan" 
                                           {{ in_array('update_sistem_pengembangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_sistem_pengembangan" 
                                           {{ in_array('delete_sistem_pengembangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_sistem_pengembangan" 
                                           {{ in_array('kategori_sistem_pengembangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>IT > Kendala</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_kendala" 
                                           {{ in_array('view_kendala', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_kendala" 
                                           {{ in_array('create_kendala', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_kendala" 
                                           {{ in_array('read_kendala', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_kendala" 
                                           {{ in_array('update_kendala', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_kendala" 
                                           {{ in_array('delete_kendala', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>IT > Rekomendasi</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_rekomendasi" 
                                           {{ in_array('view_rekomendasi', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_rekomendasi" 
                                           {{ in_array('create_rekomendasi', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_rekomendasi" 
                                           {{ in_array('read_rekomendasi', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_rekomendasi" 
                                           {{ in_array('update_rekomendasi', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_rekomendasi" 
                                           {{ in_array('delete_rekomendasi', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>Maintenance > Pengecekan Unit/Bagian</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pengecekan_unit_bagian" 
                                           {{ in_array('view_pengecekan_unit_bagian', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pengecekan_unit_bagian" 
                                           {{ in_array('create_pengecekan_unit_bagian', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pengecekan_unit_bagian" 
                                           {{ in_array('read_pengecekan_unit_bagian', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pengecekan_unit_bagian" 
                                           {{ in_array('update_pengecekan_unit_bagian', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pengecekan_unit_bagian" 
                                           {{ in_array('delete_pengecekan_unit_bagian', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>Maintenance > Maintenance Hardware</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_maintenance_hardware" 
                                           {{ in_array('view_maintenance_hardware', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_maintenance_hardware" 
                                           {{ in_array('create_maintenance_hardware', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_maintenance_hardware" 
                                           {{ in_array('read_maintenance_hardware', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_maintenance_hardware" 
                                           {{ in_array('update_maintenance_hardware', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_maintenance_hardware" 
                                           {{ in_array('delete_maintenance_hardware', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_maintenance_hardware" 
                                           {{ in_array('kategori_maintenance_hardware', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>Maintenance > Maintenance Software</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_maintenance_software" 
                                           {{ in_array('view_maintenance_software', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_maintenance_software" 
                                           {{ in_array('create_maintenance_software', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_maintenance_software" 
                                           {{ in_array('read_maintenance_software', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_maintenance_software" 
                                           {{ in_array('update_maintenance_software', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_maintenance_software" 
                                           {{ in_array('delete_maintenance_software', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_maintenance_software" 
                                           {{ in_array('kategori_maintenance_software', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td>Maintenance > Maintenance Server</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_maintenance_server" 
                                           {{ in_array('view_maintenance_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_maintenance_server" 
                                           {{ in_array('create_maintenance_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_maintenance_server" 
                                           {{ in_array('read_maintenance_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_maintenance_server" 
                                           {{ in_array('update_maintenance_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_maintenance_server" 
                                           {{ in_array('delete_maintenance_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_maintenance_server" 
                                           {{ in_array('kategori_maintenance_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>8</td>
                                <td>Maintenance > Pengecekan Suhu</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pengecekan_suhu" 
                                           {{ in_array('view_pengecekan_suhu', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pengecekan_suhu" 
                                           {{ in_array('create_pengecekan_suhu', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pengecekan_suhu" 
                                           {{ in_array('read_pengecekan_suhu', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pengecekan_suhu" 
                                           {{ in_array('update_pengecekan_suhu', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pengecekan_suhu" 
                                           {{ in_array('delete_pengecekan_suhu', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>9</td>
                                <td>Maintenance > Backup</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_backup" 
                                           {{ in_array('view_backup', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_backup" 
                                           {{ in_array('create_backup', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_backup" 
                                           {{ in_array('read_backup', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_backup" 
                                           {{ in_array('update_backup', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_backup" 
                                           {{ in_array('delete_backup', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_backup" 
                                           {{ in_array('kategori_backup', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>10</td>
                                <td>Maintenance > Evaluasi Kinerja Sistem</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_evaluasi_kinerja_sistem" 
                                           {{ in_array('view_evaluasi_kinerja_sistem', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_evaluasi_kinerja_sistem" 
                                           {{ in_array('create_evaluasi_kinerja_sistem', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_evaluasi_kinerja_sistem" 
                                           {{ in_array('read_evaluasi_kinerja_sistem', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_evaluasi_kinerja_sistem" 
                                           {{ in_array('update_evaluasi_kinerja_sistem', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_evaluasi_kinerja_sistem" 
                                           {{ in_array('delete_evaluasi_kinerja_sistem', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_evaluasi_kinerja_sistem" 
                                           {{ in_array('kategori_evaluasi_kinerja_sistem', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>11</td>
                                <td>Maintenance > Register Ruang Server</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_register_ruang_server" 
                                           {{ in_array('view_register_ruang_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_register_ruang_server" 
                                           {{ in_array('create_register_ruang_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_register_ruang_server" 
                                           {{ in_array('read_register_ruang_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_register_ruang_server" 
                                           {{ in_array('update_register_ruang_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_register_ruang_server" 
                                           {{ in_array('delete_register_ruang_server', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>12</td>
                                <td>Pelaporan > Pelaporan Keuangan</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_keuangan" 
                                           {{ in_array('view_pelaporan_keuangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_keuangan" 
                                           {{ in_array('create_pelaporan_keuangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_keuangan" 
                                           {{ in_array('read_pelaporan_keuangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_keuangan" 
                                           {{ in_array('update_pelaporan_keuangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_keuangan" 
                                           {{ in_array('delete_pelaporan_keuangan', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>13</td>
                                <td>Pelaporan > Pelaporan Regulasi > Pelaporan PEMKAB</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_pemkab" 
                                           {{ in_array('view_pelaporan_pemkab', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_pemkab" 
                                           {{ in_array('create_pelaporan_pemkab', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_pemkab" 
                                           {{ in_array('read_pelaporan_pemkab', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_pemkab" 
                                           {{ in_array('update_pelaporan_pemkab', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_pemkab" 
                                           {{ in_array('delete_pelaporan_pemkab', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>14</td>
                                <td>Pelaporan > Pelaporan Regulasi > Pelaporan OJK</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_ojk" 
                                           {{ in_array('view_pelaporan_ojk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_ojk" 
                                           {{ in_array('create_pelaporan_ojk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_ojk" 
                                           {{ in_array('read_pelaporan_ojk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_ojk" 
                                           {{ in_array('update_pelaporan_ojk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_ojk" 
                                           {{ in_array('delete_pelaporan_ojk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>15</td>
                                <td>Pelaporan > Pelaporan Regulasi > Pelaporan LPS</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_lps" 
                                           {{ in_array('view_pelaporan_lps', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_lps" 
                                           {{ in_array('create_pelaporan_lps', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_lps" 
                                           {{ in_array('read_pelaporan_lps', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_lps" 
                                           {{ in_array('update_pelaporan_lps', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_lps" 
                                           {{ in_array('delete_pelaporan_lps', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>16</td>
                                <td>Pelaporan > Pelaporan Regulasi > Pelaporan PPATK</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_ppatk" 
                                           {{ in_array('view_pelaporan_ppatk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_ppatk" 
                                           {{ in_array('create_pelaporan_ppatk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_ppatk" 
                                           {{ in_array('read_pelaporan_ppatk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_ppatk" 
                                           {{ in_array('update_pelaporan_ppatk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_ppatk" 
                                           {{ in_array('delete_pelaporan_ppatk', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>17</td>
                                <td>Pelaporan > Pelaporan Regulasi > Pelaporan DIRJEN PAJAK</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_dirjen_pajak" 
                                           {{ in_array('view_pelaporan_dirjen_pajak', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_dirjen_pajak" 
                                           {{ in_array('create_pelaporan_dirjen_pajak', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_dirjen_pajak" 
                                           {{ in_array('read_pelaporan_dirjen_pajak', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_dirjen_pajak" 
                                           {{ in_array('update_pelaporan_dirjen_pajak', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_dirjen_pajak" 
                                           {{ in_array('delete_pelaporan_dirjen_pajak', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>18</td>
                                <td>Pelaporan > Pelaporan Regulasi > Pelaporan BPJS</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_bpjs" 
                                           {{ in_array('view_pelaporan_bpjs', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_bpjs" 
                                           {{ in_array('create_pelaporan_bpjs', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_bpjs" 
                                           {{ in_array('read_pelaporan_bpjs', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_bpjs" 
                                           {{ in_array('update_pelaporan_bpjs', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_bpjs" 
                                           {{ in_array('delete_pelaporan_bpjs', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>19</td>
                                <td>Pelaporan > Pelaporan Regulasi > Pelaporan DUKCAPIL X PERBARINDO</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_dukcapil_perbarindo" 
                                           {{ in_array('view_pelaporan_dukcapil_perbarindo', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_dukcapil_perbarindo" 
                                           {{ in_array('create_pelaporan_dukcapil_perbarindo', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_dukcapil_perbarindo" 
                                           {{ in_array('read_pelaporan_dukcapil_perbarindo', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_dukcapil_perbarindo" 
                                           {{ in_array('update_pelaporan_dukcapil_perbarindo', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_dukcapil_perbarindo" 
                                           {{ in_array('delete_pelaporan_dukcapil_perbarindo', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>20</td>
                                <td>Pelaporan > Pelaporan Isidentil</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_pelaporan_isidentil" 
                                           {{ in_array('view_pelaporan_isidentil', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_pelaporan_isidentil" 
                                           {{ in_array('create_pelaporan_isidentil', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_pelaporan_isidentil" 
                                           {{ in_array('read_pelaporan_isidentil', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_pelaporan_isidentil" 
                                           {{ in_array('update_pelaporan_isidentil', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_pelaporan_isidentil" 
                                           {{ in_array('delete_pelaporan_isidentil', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td>21</td>
                                <td>Produk Perusahaan > Kredit</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_kategori_produk_kredit" 
                                           {{ in_array('view_kategori_produk_kredit', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_kategori_produk_kredit" 
                                           {{ in_array('create_kategori_produk_kredit', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_kategori_produk_kredit" 
                                           {{ in_array('read_kategori_produk_kredit', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_kategori_produk_kredit" 
                                           {{ in_array('update_kategori_produk_kredit', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_kategori_produk_kredit" 
                                           {{ in_array('delete_kategori_produk_kredit', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_produk_kredit" 
                                           {{ in_array('kategori_produk_kredit', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>21</td>
                                <td>Produk Perusahaan > Dana</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_kategori_produk_dana" 
                                           {{ in_array('view_kategori_produk_dana', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_kategori_produk_dana" 
                                           {{ in_array('create_kategori_produk_dana', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_kategori_produk_dana" 
                                           {{ in_array('read_kategori_produk_dana', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_kategori_produk_dana" 
                                           {{ in_array('update_kategori_produk_dana', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_kategori_produk_dana" 
                                           {{ in_array('delete_kategori_produk_dana', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_produk_dana" 
                                           {{ in_array('kategori_produk_dana', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>21</td>
                                <td>Produk Perusahaan > Mobile Banking</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_kategori_produk_mobile_banking" 
                                           {{ in_array('view_kategori_produk_mobile_banking', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_kategori_produk_mobile_banking" 
                                           {{ in_array('create_kategori_produk_mobile_banking', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_kategori_produk_mobile_banking" 
                                           {{ in_array('read_kategori_produk_mobile_banking', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_kategori_produk_mobile_banking" 
                                           {{ in_array('update_kategori_produk_mobile_banking', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_kategori_produk_mobile_banking" 
                                           {{ in_array('delete_kategori_produk_mobile_banking', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_produk_mobile_banking" 
                                           {{ in_array('kategori_produk_mobile_banking', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>21</td>
                                <td>Informasi > Kantor</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_kantor" 
                                           {{ in_array('view_kantor', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_kantor" 
                                           {{ in_array('create_kantor', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_kantor" 
                                           {{ in_array('read_kantor', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_kantor" 
                                           {{ in_array('update_kantor', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_kantor" 
                                           {{ in_array('delete_kantor', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="kategori_unit_bagian" 
                                           {{ in_array('kategori_unit_bagian', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                            </tr>

                            <tr>
                                <td>22</td>
                                <td>Management User</td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="view_management_user" 
                                           {{ in_array('view_management_user', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="create_management_user" 
                                           {{ in_array('create_management_user', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="read_management_user" 
                                           {{ in_array('read_management_user', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="update_management_user" 
                                           {{ in_array('update_management_user', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="permission[]" value="delete_management_user" 
                                           {{ in_array('delete_management_user', $rolePermissions) ? 'checked' : '' }}>
                                </td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>                    
                    
                </div>
        
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ url('management_user/roles') }}" class="btn btn-danger mx-1">Kembali</a>
                </div>
            </form>
        </div>        
        
        
    </div>
<section>

@endsection