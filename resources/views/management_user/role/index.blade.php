@extends('layouts.master')

@section('title')
    Role Management
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Management User / Role Management</li>
@endsection

@section('content')

<section>

    <div class="card">
        <div class="card-header">
            <a href="{{ url('management_user/roles/create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>  Tambah Role</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="800px">Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $role)
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Display the number -->
                        <td>{{ $role->name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ url('roles/'. $role->id .'/give-permissions') }}" class="btn btn-success">
                                    <i class="fa fa-user-check"></i>
                                </a>
                                <a href="{{ url('management_user/roles/'. $role->id .'/edit') }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteRole('{{ url('roles/' . $role->id . '/delete') }}')"> <i class="fa fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<section>

{{-- Script sweetalert --}}
<script>
    function deleteRole(url) {
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