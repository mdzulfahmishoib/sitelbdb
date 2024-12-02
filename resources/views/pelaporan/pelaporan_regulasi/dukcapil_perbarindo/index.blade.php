@extends('layouts.master')

@section('title')
    Pelaporan DUKCAPIL X PERBARINDO
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pelaporan</li>
    <li class="breadcrumb-item active">Pelaporan Regulasi</li>
    <li class="breadcrumb-item active">Pelaporan DUKCAPIL X PERBARINDO</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            @can('create_pelaporan_dukcapil_perbarindo')
            <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah
                Data</button>
            @endcan
            <table id="pelaporan_dukcapil_perbarindo" class="table table-bordered table-striped table-hover table-responsive pelaporan_dukcapil_perbarindo">
                <thead>
                    <th>No</th>
                    <th>Tanggal Input Data</th>
                    <th>Periode Tahun</th>
                    <th>Jenis Periode</th>
                    <th>Nama Laporan</th>
                    <th>Nama Laporan Isidentil</th>
                    <th>Dokumen Pendukung</th>
                    <th><i class="fa fa-cog"></i> Aksi</th>
                </thead>
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>

@includeIf('pelaporan.pelaporan_regulasi.dukcapil_perbarindo.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#pelaporan_dukcapil_perbarindo").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
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
                        // Menambahkan logo ke header
                        var logoUrl = '{{ asset('img/logobpr.png')}}'; // Ganti dengan URL logo Anda
                        var header = '<div style="text-align: left; margin-bottom: 5px;">' +
                                    '<img src="' + logoUrl + '" alt="Logo" style="height: 50px;">' +
                                    '</div>';

                        $(win.document.body).prepend(header);

                        // Mengubah tampilan tabel
                        $(win.document.body).find('table')
                            .addClass('display')
                            .css('font-size', '9pt')
                            .css('width', '100%');

                        // Mengatur orientasi menjadi landscape
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
                url: '{{ route('pelaporan_dukcapil_perbarindo.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'tanggal_input_data' },
                { data: 'periode_tahun' },
                { data: 'jenis_periode' },
                { data: 'nama_laporan' },
                { data: 'nama_laporan_isidentil' },
                {
                    data: 'dokumen_pendukung',
                    render: function(data, type, full, meta) {
                        var images = data ? data.split(',') : [];
                        var imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
                        var htmlOutput = images.map(function(file) {
                            var fileExtension = file.split('.').pop().toLowerCase();

                            if (imageExtensions.includes(fileExtension)) {
                                // Jika file adalah gambar, tampilkan gambar
                                return '<img src="{{ asset('storage/pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/pelaporan/pelaporan_regulasi/pelaporan_dukcapil_perbarindo') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                { data: 'aksi', searchable: false, sortable: false },
            ],


            "initComplete": function() {
                table.buttons().container().appendTo('#pelaporan_dukcapil_perbarindo_wrapper .col-md-6:eq(0)');
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
        $('#modal-form .modal-title').text('Tambah Data Pelaporan DUKCAPIL X PERBARINDO');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumen_pendukung_up"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_input_data]').attr('disabled', false);
            $('#modal-form [name=periode_tahun]').attr('disabled', false);
            $('#modal-form [name=jenis_periode]').attr('disabled', false);
            $('#modal-form [name=nama_laporan]').attr('disabled', false);
            $('#modal-form [name=nama_laporan_isidentil]').attr('disabled', false);
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Data Pelaporan DUKCAPIL X PERBARINDO');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');
    $('#submit-button').text('Update');
    
    $('#modal-form [id=submit-button]').show();
    $('#modal-form [name="dokumen_pendukung_up"]').show();


    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_input_data]').val(response.tanggal_input_data).attr('disabled', false);
            $('#modal-form [name=periode_tahun]').val(response.periode_tahun).attr('disabled', false);
            $('#modal-form [name=jenis_periode]').val(response.jenis_periode).attr('disabled', false);
            $('#modal-form [name=nama_laporan]').val(response.nama_laporan).attr('disabled', false);
            $('#modal-form [name=nama_laporan_isidentil]').val(response.nama_laporan_isidentil).attr('disabled', false);
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function viewForm(url) { 
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Lihat Data Pelaporan DUKCAPIL X PERBARINDO');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');

    $('#modal-form [id=submit-button]').hide();
    $('#modal-form [name="dokumen_pendukung_up"]').hide();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_input_data]').val(response.tanggal_input_data).attr('disabled', true);
            $('#modal-form [name=periode_tahun]').val(response.periode_tahun).attr('disabled', true);
            $('#modal-form [name=jenis_periode]').val(response.jenis_periode).attr('disabled', true);
            $('#modal-form [name=nama_laporan]').val(response.nama_laporan).attr('disabled', true);
            $('#modal-form [name=nama_laporan_isidentil]').val(response.nama_laporan_isidentil).attr('disabled', true);
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
</script>

@endpush
