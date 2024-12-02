@extends('layouts.master')

@section('title')
    List Kantor
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Informasi</li>
    <li class="breadcrumb-item active">Kantor</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            <div class="btn-group">
                @can('create_kantor')
                <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah
                    Kantor</button>
                @endcan
                @can('kategori_unit_bagian')
                        <a href="{{ route('unit_bagian.index') }}" class="btn btn-warning mb-2"><i class="fa fa-list"></i> Kategori Unit/Bagian</a>
                @endcan
            </div>
            <table id="kantor" class="table table-bordered table-striped table-hover table-responsive kantor">
                <thead>
                    <th>No</th>
                    <th>Nama Kantor</th>
                    <th>Jenis Kantor</th>
                    <th>Nomor Telepon</th>
                    <th>Email</th>
                    <th>Alamat Kantor</th>
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

@includeIf('informasi.kantor.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#kantor").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "columnDefs": [
                { "width": "150px", "targets": 1 },
                { "width": "100px", "targets": 2 },
                { "width": "150px", "targets": 3 },
                { "width": "150px", "targets": 4 },
                { "width": "500px", "targets": 5 },
                { "width": "80px", "targets": 6 },
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
                url: '{{ route('kantor.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'nama_kantor' },
                { data: 'jenis_kantor' },
                { data: 'telepon_kantor' },
                { data: 'email_kantor' },
                { data: 'alamat_kantor' },
                { data: 'aksi', searchable: false, sortable: false },
            ],
            "initComplete": function() {
                table.buttons().container().appendTo('#kantor_wrapper .col-md-6:eq(0)');
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
        $('#modal-form .modal-title').text('Tambah Data Kantor');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=nama_kantor]').attr('disabled', false);
            $('#modal-form [name=jenis_kantor]').attr('disabled', false);
            $('#modal-form [name=telepon_kantor]').attr('disabled', false);
            $('#modal-form [name=email_kantor]').attr('disabled', false);
            $('#modal-form [name=alamat_kantor]').attr('disabled', false);
            // Jangan mengisi input file dengan response.foto
        })
    }


    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Kantor');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#form-method').val('PUT');
        $('#submit-button').text('Update');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=nama_kantor]').val(response.nama_kantor).attr('disabled', false);
            $('#modal-form [name=jenis_kantor]').val(response.jenis_kantor).attr('disabled', false);
            $('#modal-form [name=telepon_kantor]').val(response.telepon_kantor).attr('disabled', false);
            $('#modal-form [name=email_kantor]').val(response.email_kantor).attr('disabled', false);
            $('#modal-form [name=alamat_kantor]').val(response.alamat_kantor).attr('disabled', false);
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
            $('#modal-form [name=nama_kantor]').val(response.nama_kantor).attr('disabled', true);
            $('#modal-form [name=jenis_kantor]').val(response.jenis_kantor).attr('disabled', true);
            $('#modal-form [name=telepon_kantor]').val(response.telepon_kantor).attr('disabled', true);
            $('#modal-form [name=email_kantor]').val(response.email_kantor).attr('disabled', true);
            $('#modal-form [name=alamat_kantor]').val(response.alamat_kantor).attr('disabled', true);
            // Jangan mengisi input file dengan response.foto
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
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
