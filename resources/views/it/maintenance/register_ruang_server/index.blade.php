@extends('layouts.master')

@section('title')
    Register Ruangan Server
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">IT</li>
    <li class="breadcrumb-item active">Maintenance</li>
    <li class="breadcrumb-item active">Register Ruangan Server</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            @can('create_register_ruang_server')
                <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah Data</button>
            @endcan
            <table id="register_ruang_server" class="table table-bordered table-striped table-hover table-responsive register_ruang_server">
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Petugas</th>
                    <th>Keperluan</th>
                    <th>Kategori Urgensi</th>
                    <th>Pihak</th>
                    <th>Bagian/Instansi</th>
                    <th>Keterangan Tambahan</th>
                    <th>Dokumentasi</th>
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

@includeIf('it.maintenance.register_ruang_server.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#register_ruang_server").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "columnDefs": [
                { targets: [6], visible: false },
                { "width": "170px", "targets": 4 },
                { "width": "170px", "targets": 7 },
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
                url: '{{ route('register_ruang_server.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'tanggal_register_ruang_server' },
                { data: 'nama_petugas' },
                { data: 'keperluan' },
                { data: 'kategori_urgensi' },
                { data: 'pihak' },
                { data: 'bagian_instansi' },
                { data: 'keterangan_tambahan' },
                {
                    data: 'dokumentasi_db',
                    render: function(data, type, full, meta) {
                        var images = data ? data.split(',') : [];
                        var imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
                        var htmlOutput = images.map(function(file) {
                            var fileExtension = file.split('.').pop().toLowerCase();

                            if (imageExtensions.includes(fileExtension)) {
                                // Jika file adalah gambar, tampilkan gambar
                                return '<img src="{{ asset('storage/it/maintenance/register_ruang_server') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/it/maintenance/register_ruang_server') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                { data: 'aksi', searchable: false, sortable: false },
            ],
            "initComplete": function() {
                table.buttons().container().appendTo('#register_ruang_server_wrapper .col-md-6:eq(0)');
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
        $('#modal-form .modal-title').text('Tambah Data Register Ruangan Server');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_register_ruang_server]').attr('disabled', false);
            $('#modal-form [name=nama_petugas]').attr('disabled', false);
            $('#modal-form [name=keperluan]').attr('disabled', false);
            $('#modal-form [name=kategori_urgensi]').attr('disabled', false);
            $('#modal-form [name=pihak]').attr('disabled', false);
            $('#modal-form [name=bagian_instansi]').attr('disabled', false);
            $('#modal-form [name=keterangan_tambahan]').attr('disabled', false);
            // Jangan mengisi input file dengan response.foto
        })
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Register Ruangan Server');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#form-method').val('PUT');
        $('#submit-button').text('Update');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_register_ruang_server]').val(response.tanggal_register_ruang_server).attr('disabled', false);
            $('#modal-form [name=nama_petugas]').val(response.nama_petugas).attr('disabled', false);
            $('#modal-form [name=keperluan]').val(response.keperluan).attr('disabled', false);
            $('#modal-form [name=kategori_urgensi]').val(response.kategori_urgensi).attr('disabled', false);
            $('#modal-form [name=pihak]').val(response.pihak).attr('disabled', false);
            $('#modal-form [name=bagian_instansi]').val(response.bagian_instansi).attr('disabled', false);
            $('#modal-form [name=keterangan_tambahan]').val(response.keterangan_tambahan).attr('disabled', false);
            // Jangan mengisi input file dengan response.foto
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
        });
    }

    function viewForm(url) { 
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Lihat Data Register Ruang Server');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');

    $('#modal-form [id=submit-button]').hide();
    $('#modal-form [name="dokumentasi[]"]').hide();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_register_ruang_server]').val(response.tanggal_register_ruang_server).attr('disabled', true);
            $('#modal-form [name=nama_petugas]').val(response.nama_petugas).attr('disabled', true);
            $('#modal-form [name=keperluan]').val(response.keperluan).attr('disabled', true);
            $('#modal-form [name=kategori_urgensi]').val(response.kategori_urgensi).attr('disabled', true);
            $('#modal-form [name=pihak]').val(response.pihak).attr('disabled', true);
            $('#modal-form [name=bagian_instansi]').val(response.bagian_instansi).attr('disabled', true);
            $('#modal-form [name=keterangan_tambahan]').val(response.keterangan_tambahan).attr('disabled', true);
            // Jangan mengisi input file dengan response.foto
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
        });
    }

    function cloneForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Clone Data Register Ruang Server');

        // Reset form
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '{{ route("register_ruang_server.store") }}'); // Gunakan route store untuk menyimpan data baru
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        // Fetch data from server
        $.get(url)
            .done(function(response) {
                $('#modal-form [name=tanggal_register_ruang_server]').val(response.tanggal_register_ruang_server).attr('disabled', false);
                $('#modal-form [name=nama_petugas]').val(response.nama_petugas).attr('disabled', false);
                $('#modal-form [name=keperluan]').val(response.keperluan).attr('disabled', false);
                $('#modal-form [name=kategori_urgensi]').val(response.kategori_urgensi).attr('disabled', false);
                $('#modal-form [name=pihak]').val(response.pihak).attr('disabled', false);
                $('#modal-form [name=bagian_instansi]').val(response.bagian_instansi).attr('disabled', false);
                $('#modal-form [name=keterangan_tambahan]').val(response.keterangan_tambahan).attr('disabled', false);
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


    //Fitur untuk membuka gambar di tab baru
    function showImageModal(imageUrl) {
    var fullImageUrl = '{{ asset('storage/it/maintenance/register_ruang_server') }}/' + imageUrl;
    document.getElementById('modalImage').src = fullImageUrl;
    $('#imageModal').modal('show');
    }
</script>

@endpush
