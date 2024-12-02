@extends('layouts.master')

@section('title')
    Pengecekan Perangkat Unit/Bagian
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">IT</li>
    <li class="breadcrumb-item active">Maintenance</li>
    <li class="breadcrumb-item active">Pengecekan Perangkat Unit/Bagian</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            @can('create_pengecekan_unit_bagian')
            <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah
                Data</button>
            @endcan
            <table id="pengecekan_unit_bagian" class="table table-bordered table-striped table-hover table-responsive pengecekan_unit_bagian">
                <thead>
                    <th>No</th>
                    <th>Kantor</th>
                    <th>Unit/Bagian</th>
                    <th>Tgl Pengecekan</th>
                    <th>Komputer Laptop</th>
                    <th>Printer</th>
                    <th>Scan</th>
                    <th>Jaringan</th>
                    <th>Mesin Hitung</th>
                    <th>Windows</th>
                    <th>Microsoft Office</th>
                    <th>Antivirus</th>
                    <th>Browser</th>
                    <th>CBS</th>
                    <th>Cek E-KTP</th>
                    <th>Cek DVR CCTV</th>
                    <th>Keterangan Tambahan</th>
                    <th>Dokumentasi</th>
                    <th><i class="fa fa-cog"></i> Aksi</th>
                </thead>
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>

@includeIf('it.maintenance.pengecekan_unit_bagian.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#pengecekan_unit_bagian").DataTable({
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
                url: '{{ route('pengecekan_unit_bagian.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'nama_kantor' },
                { data: 'nama_unit_bagian' },
                { data: 'tanggal_pengecekan_unit_bagian' },
                { data: 'komputer_laptop' },
                { data: 'printer' },
                { data: 'scan' },
                { data: 'jaringan' },
                { data: 'mesin_hitung' },
                { data: 'windows' },
                { data: 'microsoft_office' },
                { data: 'antivirus' },
                { data: 'browser' },
                { data: 'cbs' },
                { data: 'cek_ktp' },
                { data: 'dvr_mikrotik' },
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
                                return '<img src="{{ asset('storage/it/maintenance/pengecekan_unit_bagian') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/it/maintenance/pengecekan_unit_bagian') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                { data: 'aksi', searchable: false, sortable: false },
            ],


            "initComplete": function() {
                table.buttons().container().appendTo('#pengecekan_unit_bagian_wrapper .col-md-6:eq(0)');
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
        $('#modal-form .modal-title').text('Tambah Data Pengecekan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=id_kantor]').attr('disabled', false);
            $('#modal-form [name=id_unit_bagian]').attr('disabled', false);
            $('#modal-form [name=tanggal_pengecekan_unit_bagian]').attr('disabled', false);
            $('#modal-form [name=komputer_laptop]').attr('disabled', false);
            $('#modal-form [name=printer]').attr('disabled', false);
            $('#modal-form [name=scan]').attr('disabled', false);
            $('#modal-form [name=jaringan]').attr('disabled', false);
            $('#modal-form [name=mesin_hitung]').attr('disabled', false);
            $('#modal-form [name=windows]').attr('disabled', false);
            $('#modal-form [name=microsoft_office]').attr('disabled', false);
            $('#modal-form [name=antivirus]').attr('disabled', false);
            $('#modal-form [name=browser]').attr('disabled', false);
            $('#modal-form [name=cbs]').attr('disabled', false);
            $('#modal-form [name=cek_ktp]').attr('disabled', false);
            $('#modal-form [name=dvr_mikrotik]').attr('disabled', false);
            $('#modal-form [name=keterangan_tambahan]').attr('disabled', false);
            // No need to fill file inputs
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Data Pengecekan');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');
    $('#submit-button').text('Update');
    
    $('#modal-form [id=submit-button]').show();
    $('#modal-form [name="dokumentasi[]"]').show();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=id_kantor]').val(response.id_kantor).attr('disabled', false);
            $('#modal-form [name=id_unit_bagian]').val(response.id_unit_bagian).attr('disabled', false);
            $('#modal-form [name=tanggal_pengecekan_unit_bagian]').val(response.tanggal_pengecekan_unit_bagian).attr('disabled', false);
            $('#modal-form [name=komputer_laptop]').val(response.komputer_laptop).attr('disabled', false);
            $('#modal-form [name=printer]').val(response.printer).attr('disabled', false);
            $('#modal-form [name=scan]').val(response.scan).attr('disabled', false);
            $('#modal-form [name=jaringan]').val(response.jaringan).attr('disabled', false);
            $('#modal-form [name=mesin_hitung]').val(response.mesin_hitung).attr('disabled', false);
            $('#modal-form [name=windows]').val(response.windows).attr('disabled', false);
            $('#modal-form [name=microsoft_office]').val(response.microsoft_office).attr('disabled', false);
            $('#modal-form [name=antivirus]').val(response.antivirus).attr('disabled', false);
            $('#modal-form [name=browser]').val(response.browser).attr('disabled', false);
            $('#modal-form [name=cbs]').val(response.cbs).attr('disabled', false);
            $('#modal-form [name=cek_ktp]').val(response.cek_ktp).attr('disabled', false);
            $('#modal-form [name=dvr_mikrotik]').val(response.dvr_mikrotik).attr('disabled', false);
            $('#modal-form [name=keterangan_tambahan]').val(response.keterangan_tambahan).attr('disabled', false);
            // No need to fill file inputs
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function viewForm(url) { 
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Lihat Data Pengecekan');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');

    $('#modal-form [id=submit-button]').hide();
    $('#modal-form [name="dokumentasi[]"]').hide();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=id_kantor]').val(response.id_kantor).attr('disabled', true);
            $('#modal-form [name=id_unit_bagian]').val(response.id_unit_bagian).attr('disabled', true);
            $('#modal-form [name=tanggal_pengecekan_unit_bagian]').val(response.tanggal_pengecekan_unit_bagian).attr('disabled', true);
            $('#modal-form [name=komputer_laptop]').val(response.komputer_laptop).attr('disabled', true);
            $('#modal-form [name=printer]').val(response.printer).attr('disabled', true);
            $('#modal-form [name=scan]').val(response.scan).attr('disabled', true);
            $('#modal-form [name=jaringan]').val(response.jaringan).attr('disabled', true);
            $('#modal-form [name=mesin_hitung]').val(response.mesin_hitung).attr('disabled', true);
            $('#modal-form [name=windows]').val(response.windows).attr('disabled', true);
            $('#modal-form [name=microsoft_office]').val(response.microsoft_office).attr('disabled', true);
            $('#modal-form [name=antivirus]').val(response.antivirus).attr('disabled', true);
            $('#modal-form [name=browser]').val(response.browser).attr('disabled', true);
            $('#modal-form [name=cbs]').val(response.cbs).attr('disabled', true);
            $('#modal-form [name=cek_ktp]').val(response.cek_ktp).attr('disabled', true);
            $('#modal-form [name=dvr_mikrotik]').val(response.dvr_mikrotik).attr('disabled', true);
            $('#modal-form [name=keterangan_tambahan]').val(response.keterangan_tambahan).attr('disabled', true);
            // No need to fill file inputs
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
