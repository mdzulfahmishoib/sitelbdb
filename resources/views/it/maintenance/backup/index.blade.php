@extends('layouts.master')

@section('title')
    Backup
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">IT</li>
    <li class="breadcrumb-item active">Maintenance</li>
    <li class="breadcrumb-item active">Backup</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            <div class="btn-group">
                @can('create_backup')
                    <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                @endcan
                @can('kategori_backup')
                    <a href="{{ route('kategori_backup.index') }}" class="btn btn-warning mb-2"><i class="fa fa-list"></i> Data Kategori</a>
                @endcan
            </div>

            <table id="backup" class="table table-bordered table-striped table-hover table-responsive backup">
                <thead>
                    <th>No</th>
                    <th>Objek Backup</th>
                    <th>Tanggal Backup</th>
                    <th>Metode Backup</th>
                    <th>Jenis Backup</th>
                    <th>Waktu Backup</th>
                    <th>Nama File Backup</th>
                    <th>Nama Petugas Backup</th>
                    <th>Validasi Backup</th>
                    <th>Nama Petugas Validasi</th>
                    <th>Keterangan Backup</th>
                    <th><i class="fa fa-cog"></i> Aksi</th>
                </thead>
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    {{-- Kode untuk menampilkan gambar secara penuh pada modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="imageModalLabel">Dokumentasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <img id="modalImage" src="" class="img-fluid" alt="Gambar penuh"/>
            </div>
          </div>
        </div>
    </div>

</section>

@includeIf('it.maintenance.backup.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#backup").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "columnDefs": [
                { targets: [3, 4, 5, 7, 10], visible: false },
                { "width": "120px", "targets": 2 },
                { "width": "110px", "targets": 8 },
                { "width": "250px", "targets": 10 },
            ],
            buttons: [
                'copy',
                'csv',
                'excel',
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    customize: function (doc) {
                        doc.styles.tableHeader = {
                            bold: true,
                            fontSize: 9,
                            color: 'black',
                            fillColor: 'gray'
                        };
                        doc.styles.tableBodyOdd = {
                            fillColor: '#f3f3f3'
                        };
                        doc.styles.tableBodyEven = {
                            fillColor: '#ffffff'
                        };
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    customize: function (win) {
                        $(win.document.body).find('table')
                            .addClass('display')
                            .css('font-size', '9pt')
                            .css('width', '100%');

                        // Set the orientation to landscape
                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');

                        style.type = 'text/css';
                        style.media = 'print';

                        if (style.styleSheet) {
                            style.styleSheet.cssText = css;
                        } else {
                            style.appendChild(win.document.createTextNode(css));
                        }

                        head.appendChild(style);
                    }
                },
                'colvis'
            ],
            ajax: {
                url: '{{ route('backup.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'kategori_backup' },
                { data: 'tanggal_backup' },
                { data: 'metode_backup' },
                { data: 'jenis_backup' },
                { data: 'waktu_backup' },
                { data: 'nama_file_backup' },
                { data: 'nama_petugas_backup' },
                { data: 'validasi_backup' },
                { data: 'nama_petugas_validasi' },
                { data: 'keterangan_backup' },
                { data: 'aksi', searchable: false, sortable: false },
            ],
            "initComplete": function() {
                table.buttons().container().appendTo('#backup_wrapper .col-md-6:eq(0)');
            }
        });

        $('#modal-form').validator().on('submit', function (e) {
            e.preventDefault(); // Mencegah submit form secara default

            var form = $('#modal-form form')[0]; // Ambil elemen form
            var formData = new FormData(form); // Buat FormData dari elemen form

            $.ajax({
                url: $(form).attr('action'), // URL aksi form
                type: 'POST',
                data: formData,
                processData: false, // Cegah jQuery dari memproses data
                contentType: false, // Set contentType ke false agar FormData yang menangani
                success: function(response) {
                    if (response.success) { // Cek apakah respons sukses dari server
                        $('#modal-form').modal('hide'); // Sembunyikan modal jika sukses
                        table.ajax.reload(null, false); // Muat ulang DataTable tanpa kembali ke halaman 1

                        // Notifikasi SweetAlert untuk sukses
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            text: response.message // Tampilkan pesan dari server
                        });
                    }
                },
                error: function(errors) {
                    alert('Gagal menyimpan data!'); // Tampilkan pesan error
                }
            });
        });

    });


    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Data Backup');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=id_kategori_backup]').attr('disabled', false);
            $('#modal-form [name=tanggal_backup]').attr('disabled', false);
            $('#modal-form [name=metode_backup]').attr('disabled', false);
            $('#modal-form [name=jenis_backup]').attr('disabled', false);
            $('#modal-form [name=waktu_backup]').attr('disabled', false);
            $('#modal-form [name=nama_file_backup]').attr('disabled', false);
            $('#modal-form [name=nama_petugas_backup]').attr('disabled', false);
            $('#modal-form [name=validasi_backup]').attr('disabled', false);
            $('#modal-form [name=nama_petugas_validasi]').attr('disabled', false);
            $('#modal-form [name=keterangan_backup]').attr('disabled', false);
            // Jangan mengisi input file dengan response.foto
        })
    }


    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Backup');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#form-method').val('PUT');
        $('#submit-button').text('Update');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=id_kategori_backup]').val(response.id_kategori_backup).attr('disabled', false);
            $('#modal-form [name=tanggal_backup]').val(response.tanggal_backup).attr('disabled', false);
            $('#modal-form [name=metode_backup]').val(response.metode_backup).attr('disabled', false);
            $('#modal-form [name=jenis_backup]').val(response.jenis_backup).attr('disabled', false);
            $('#modal-form [name=waktu_backup]').val(response.waktu_backup).attr('disabled', false);
            $('#modal-form [name=nama_file_backup]').val(response.nama_file_backup).attr('disabled', false);
            $('#modal-form [name=nama_petugas_backup]').val(response.nama_petugas_backup).attr('disabled', false);
            $('#modal-form [name=validasi_backup]').val(response.validasi_backup).attr('disabled', false);
            $('#modal-form [name=nama_petugas_validasi]').val(response.nama_petugas_validasi).attr('disabled', false);
            $('#modal-form [name=keterangan_backup]').val(response.keterangan_backup).attr('disabled', false);
            // Jangan mengisi input file dengan response.foto
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
        });
    }

    function viewForm(url) { 
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Lihat Data Kantor');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');

    $('#modal-form [id=submit-button]').hide();
    $('#modal-form [name="dokumentasi[]"]').hide();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=id_kategori_backup]').val(response.id_kategori_backup).attr('disabled', true);
            $('#modal-form [name=tanggal_backup]').val(response.tanggal_backup).attr('disabled', true);
            $('#modal-form [name=metode_backup]').val(response.metode_backup).attr('disabled', true);
            $('#modal-form [name=jenis_backup]').val(response.jenis_backup).attr('disabled', true);
            $('#modal-form [name=waktu_backup]').val(response.waktu_backup).attr('disabled', true);
            $('#modal-form [name=nama_file_backup]').val(response.nama_file_backup).attr('disabled', true);
            $('#modal-form [name=nama_petugas_backup]').val(response.nama_petugas_backup).attr('disabled', true);
            $('#modal-form [name=validasi_backup]').val(response.validasi_backup).attr('disabled', true);
            $('#modal-form [name=nama_petugas_validasi]').val(response.nama_petugas_validasi).attr('disabled', true);
            $('#modal-form [name=keterangan_backup]').val(response.keterangan_backup).attr('disabled', true);
            // Jangan mengisi input file dengan response.foto
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
        });
    }

    function cloneForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Clone Data Backup');

        // Reset form
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '{{ route("backup.store") }}'); // Gunakan route store untuk menyimpan data baru
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        // Fetch data from server
        $.get(url)
            .done(function(response) {
                $('#modal-form [name=id_kategori_backup]').val(response.id_kategori_backup).attr('disabled', false);
                $('#modal-form [name=tanggal_backup]').val(response.tanggal_backup).attr('disabled', false);
                $('#modal-form [name=metode_backup]').val(response.metode_backup).attr('disabled', false);
                $('#modal-form [name=jenis_backup]').val(response.jenis_backup).attr('disabled', false);
                $('#modal-form [name=waktu_backup]').val(response.waktu_backup).attr('disabled', false);
                $('#modal-form [name=nama_file_backup]').val(response.nama_file_backup).attr('disabled', false);
                $('#modal-form [name=nama_petugas_backup]').val(response.nama_petugas_backup).attr('disabled', false);
                $('#modal-form [name=validasi_backup]').val(response.validasi_backup).attr('disabled', false);
                $('#modal-form [name=nama_petugas_validasi]').val(response.nama_petugas_validasi).attr('disabled', false);
                $('#modal-form [name=keterangan_backup]').val(response.keterangan_backup).attr('disabled', false);
                // Jangan mengisi input file dengan response.foto
            })
            .fail(function() {
                alert('Data tidak dapat diambil');
            });
    }


    function deleteData(url) {
        Swal.fire({
            title: 'Apakah yakin ingin menghapus data ini?',
            text: "Data yang sudah dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Simpan informasi halaman saat ini sebelum menghapus data
                let currentPage = table.page();

                $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'DELETE'
                })
                .done((response) => {
                    if (response.success) {
                        // Reload DataTable tanpa mengubah halaman
                        table.ajax.reload(null, false); // `false` agar tetap di halaman yang sama
                        
                        // Tampilkan notifikasi sukses
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            text: response.message
                        });
                    }
                })
                .fail((errors) => {
                    // Tampilkan notifikasi error jika gagal
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        text: 'Gagal menghapus data!'
                    });
                });
            }
        });
    }

</script>

@endpush
