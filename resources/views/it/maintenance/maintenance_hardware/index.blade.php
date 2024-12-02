@extends('layouts.master')

@section('title')
    Maintenance & Pengecekan Hardware
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">IT</li>
    <li class="breadcrumb-item active">Maintenance</li>
    <li class="breadcrumb-item active">Maintenance Hardware</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            <div class="btn-group">
                @can('create_maintenance_hardware')
                    <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah Data</button>
                @endcan
                @can('kategori_maintenance_hardware')
                    <a href="{{ route('kategori_maintenance_hardware.index') }}" class="btn btn-warning mb-2"><i class="fa fa-list"></i> Data Kategori</a>
                @endcan
            </div>
            <table id="maintenance_hardware" class="table table-bordered table-striped table-hover table-responsive maintenance_hardware">
                <thead>
                    <th>No</th>
                    <th>Tanggal Maintenance</th>
                    <th>Kategori</th>
                    <th>Kondisi</th>
                    <th>Keterangan Maintenance</th>
                    <th>Kantor</th>
                    <th>Dicek Oleh</th>
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

@includeIf('it.maintenance.maintenance_hardware.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#maintenance_hardware").DataTable({
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
                url: '{{ route('maintenance_hardware.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'tanggal_maintenance_hardware' },
                { data: 'nama_kategori' },
                { data: 'kondisi_maintenance_hardware' },
                { data: 'keterangan_maintenance_hardware' },
                { data: 'nama_kantor' },
                { data: 'dicek_oleh' },
                { data: 'keterangan_tambahan_maintenance_hardware' },
                {
                    data: 'dokumentasi_db',
                    render: function(data, type, full, meta) {
                        var images = data ? data.split(',') : [];
                        var imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
                        var htmlOutput = images.map(function(file) {
                            var fileExtension = file.split('.').pop().toLowerCase();

                            if (imageExtensions.includes(fileExtension)) {
                                // Jika file adalah gambar, tampilkan gambar
                                return '<img src="{{ asset('storage/it/maintenance/maintenance_hardware') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/it/maintenance/maintenance_hardware') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                { data: 'aksi', searchable: false, sortable: false },
            ],
            "initComplete": function() {
                table.buttons().container().appendTo('#maintenance_hardware_wrapper .col-md-6:eq(0)');
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
        $('#modal-form .modal-title').text('Tambah Data Maintenance & Pengecekan Hardware');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_maintenance_hardware]').attr('disabled', false);
            $('#modal-form [name=id_kategori_maintenance_hardware]').attr('disabled', false);
            $('#modal-form [name=kondisi_maintenance_hardware]').attr('disabled', false);
            $('#modal-form [name=keterangan_maintenance_hardware]').attr('disabled', false);
            $('#modal-form [name=id_kantor]').attr('disabled', false);
            $('#modal-form [name=dicek_oleh]').attr('disabled', false);
            $('#modal-form [name=keterangan_tambahan_maintenance_hardware]').attr('disabled', false);
            // Jangan mengisi input file dengan response.foto
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
        });
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Data Maintenance & Pengecekan Hardware');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#form-method').val('PUT');
        $('#submit-button').text('Update');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_maintenance_hardware]').val(response.tanggal_maintenance_hardware).attr('disabled', false);
            $('#modal-form [name=id_kategori_maintenance_hardware]').val(response.id_kategori_maintenance_hardware).attr('disabled', false);
            $('#modal-form [name=kondisi_maintenance_hardware]').val(response.kondisi_maintenance_hardware).attr('disabled', false);
            $('#modal-form [name=keterangan_maintenance_hardware]').val(response.keterangan_maintenance_hardware).attr('disabled', false);
            $('#modal-form [name=id_kantor]').val(response.id_kantor).attr('disabled', false);
            $('#modal-form [name=dicek_oleh]').val(response.dicek_oleh).attr('disabled', false);
            $('#modal-form [name=keterangan_tambahan_maintenance_hardware]').val(response.keterangan_tambahan_maintenance_hardware).attr('disabled', false);
            // Jangan mengisi input file dengan response.foto
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
        });
    }


    function viewForm(url) { 
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Lihat Data Maintenance Hardware');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');

    $('#modal-form [id=submit-button]').hide();
    $('#modal-form [name="dokumentasi[]"]').hide();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_maintenance_hardware]').val(response.tanggal_maintenance_hardware).attr('disabled', true);
            $('#modal-form [name=id_kategori_maintenance_hardware]').val(response.id_kategori_maintenance_hardware).attr('disabled', true);
            $('#modal-form [name=kondisi_maintenance_hardware]').val(response.kondisi_maintenance_hardware).attr('disabled', true);
            $('#modal-form [name=keterangan_maintenance_hardware]').val(response.keterangan_maintenance_hardware).attr('disabled', true);
            $('#modal-form [name=id_kantor]').val(response.id_kantor).attr('disabled', true);
            $('#modal-form [name=dicek_oleh]').val(response.dicek_oleh).attr('disabled', true);
            $('#modal-form [name=keterangan_tambahan_maintenance_hardware]').val(response.keterangan_tambahan_maintenance_hardware).attr('disabled', true);
        })
        .fail((errors) => {
            alert('Cannot display data');
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
    var fullImageUrl = '{{ asset('storage/it/maintenance/maintenance_hardware') }}/' + imageUrl;
    document.getElementById('modalImage').src = fullImageUrl;
    $('#imageModal').modal('show');
    }
</script>

@endpush
