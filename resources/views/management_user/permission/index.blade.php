@extends('layouts.master')

@section('title')
    Permission Management
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / Permission Management</li>
@endsection

@section('content')

<section class="content">

    <div class="card">
        <div class="card-header">
            <a href="{{ url('management_user/permission/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>  Tambah Permission</a>
        </div>
        <div class="card-body">
            <p class="text-danger">Dimohon untuk tidak mengubah atau menghapus permission basis data di bawah ini kecuali jika benar-benar diperlukan, karena permission tersebut saling terkait dengan tampilan dan fungsi program lainnya.</p>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="1000px">Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Pengelompokan data berdasarkan kata sebelum karakter "_"
                        $groupedPermissions = [];
                        foreach ($permissions as $permission) {
                            $key = strtok($permission->name, '_'); // Mengambil kata sebelum karakter "_"
                            $groupedPermissions[$key][] = $permission;
                        }
                    @endphp

                    @foreach ($groupedPermissions as $key => $permissionsGroup)
                        <tr>
                            <td colspan="3" style="text-transform: capitalize; text-align: center; font-weight: bold; color:white; background-color: #007BFF;"><?= $key ?></td>
                        </tr>
                        @foreach ($permissionsGroup as $index => $permission)
                            <tr>
                                <td>{{ $loop->parent->iteration + $index }}</td> <!-- Menampilkan nomor urut -->
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ url('management_user/permission/'. $permission->id .'/edit') }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="deletePermission('{{ url('permission/' . $permission->id . '/delete') }}')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>                
            </table>
        </div>
    </div>
</section>

    <script>
        function deletePermission(url) {
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete URL if confirmed
                    window.location.href = url;
                }
            });
        }
    </script>

@endsection
