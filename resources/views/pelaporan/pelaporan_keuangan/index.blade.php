@extends('layouts.master')

@section('title')
    Pelaporan Keuangan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pelaporan</li>
    <li class="breadcrumb-item active">Pelaporan Keuangan</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            @can('create_pelaporan_keuangan')
            <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah
                Data</button>
            @endcan
            <table id="pelaporan_keuangan" class="table table-bordered table-striped table-hover table-responsive pelaporan_keuangan">
                <thead>
                    <th>No</th>
                    <th>Tanggal Input Data</th>
                    <th>Periode Tahun</th>
                    <th>Periode Bulan</th>
                    <th>Asset</th>
                    <th>Kredit Yang Diberikan</th>
                    <th>Penempatan Pada Bank Lain</th>
                    <th>Tabungan</th>
                    <th>Deposito</th>
                    <th>Pendapatan Operasional</th>
                    <th>Pendapatan Non Operasional</th>
                    <th>Biaya Operasional</th>
                    <th>Biaya Non Operasional</th>
                    <th>Laba Sebelum Pajak</th>
                    <th>Pajak</th>
                    <th>Laba Setelah Pajak</th>
                    <th>KAP</th>
                    <th>KPMM / CAR</th>
                    <th>NPL Netto</th>
                    <th>PPAP</th>
                    <th>LDR</th>
                    <th>ROA</th>
                    <th>ROE</th>
                    <th>BOPO</th>
                    <th>NIM</th>
                    <th>CR</th>
                    <th>Lap. Posisi Keuangan</th>
                    <th>Lap. Laba Rugi</th>
                    <th>Lap. Kualitas Aset Produktif</th>
                    <th><i class="fa fa-cog"></i> Aksi</th>
                </thead>
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>

@includeIf('pelaporan.pelaporan_keuangan.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#pelaporan_keuangan").DataTable({
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
                url: '{{ route('pelaporan_keuangan.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'tanggal_input_data' },
                { data: 'periode_tahun' },
                { data: 'periode_bulan' },
                { data: 'asset' },
                { data: 'kredit' },
                { data: 'penempatan_bank_lain' },
                { data: 'tabungan' },
                { data: 'deposito' },
                { data: 'pendapatan_operasional' },
                { data: 'pendapatan_non_operasional' },
                { data: 'biaya_operasional' },
                { data: 'biaya_non_operasional' },
                { data: 'laba_sebelum_pajak' },
                { data: 'pajak' },
                { data: 'laba_setelah_pajak' },
                { data: 'kap' },
                { data: 'kpmm' },
                { data: 'npl' },
                { data: 'ppap' },
                { data: 'ldr' },
                { data: 'roa' },
                { data: 'roe' },
                { data: 'bopo' },
                { data: 'nim' },
                { data: 'cr' },
                {
                    data: 'posisi_keuangan',
                    render: function(data, type, full, meta) {
                        var images = data ? data.split(',') : [];
                        var imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
                        var htmlOutput = images.map(function(file) {
                            var fileExtension = file.split('.').pop().toLowerCase();

                            if (imageExtensions.includes(fileExtension)) {
                                // Jika file adalah gambar, tampilkan gambar
                                return '<img src="{{ asset('storage/pelaporan/pelaporan_keuangan/posisi_keuangan') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/pelaporan/pelaporan_keuangan/posisi_keuangan') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                {
                    data: 'laba_rugi',
                    render: function(data, type, full, meta) {
                        var images = data ? data.split(',') : [];
                        var imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
                        var htmlOutput = images.map(function(file) {
                            var fileExtension = file.split('.').pop().toLowerCase();

                            if (imageExtensions.includes(fileExtension)) {
                                // Jika file adalah gambar, tampilkan gambar
                                return '<img src="{{ asset('storage/pelaporan/pelaporan_keuangan/laba_rugi') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/pelaporan/pelaporan_keuangan/laba_rugi') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                {
                    data: 'kualitas_aset_produktif',
                    render: function(data, type, full, meta) {
                        var images = data ? data.split(',') : [];
                        var imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
                        var htmlOutput = images.map(function(file) {
                            var fileExtension = file.split('.').pop().toLowerCase();

                            if (imageExtensions.includes(fileExtension)) {
                                // Jika file adalah gambar, tampilkan gambar
                                return '<img src="{{ asset('storage/pelaporan/pelaporan_keuangan/kualitas_aset_produktif') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/pelaporan/pelaporan_keuangan/kualitas_aset_produktif') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                { data: 'aksi', searchable: false, sortable: false },
            ],


            "initComplete": function() {
                table.buttons().container().appendTo('#pelaporan_keuangan_wrapper .col-md-6:eq(0)');
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
        $('#modal-form .modal-title').text('Tambah Data Pelaporan Keuangan');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="posisi_keuangan"]').show();
        $('#modal-form [name="laba_rugi"]').show();
        $('#modal-form [name="kualitas_aset_produktif"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_input_data]').attr('disabled', false);
            $('#modal-form [name=periode_tahun]').attr('disabled', false);
            $('#modal-form [name=periode_bulan]').attr('disabled', false);
            $('#modal-form [name=asset]').attr('disabled', false);
            $('#modal-form [name=kredit]').attr('disabled', false);
            $('#modal-form [name=penempatan_bank_lain]').attr('disabled', false);
            $('#modal-form [name=tabungan]').attr('disabled', false);
            $('#modal-form [name=deposito]').attr('disabled', false);
            $('#modal-form [name=pendapatan_operasional]').attr('disabled', false);
            $('#modal-form [name=pendapatan_non_operasional]').attr('disabled', false);
            $('#modal-form [name=biaya_operasional]').attr('disabled', false);
            $('#modal-form [name=biaya_non_operasional]').attr('disabled', false);
            $('#modal-form [name=laba_sebelum_pajak]').attr('disabled', false);
            $('#modal-form [name=pajak]').attr('disabled', false);
            $('#modal-form [name=laba_setelah_pajak]').attr('disabled', false);
            $('#modal-form [name=kap]').attr('disabled', false);
            $('#modal-form [name=kpmm]').attr('disabled', false);
            $('#modal-form [name=npl]').attr('disabled', false);
            $('#modal-form [name=ppap]').attr('disabled', false);
            $('#modal-form [name=ldr]').attr('disabled', false);
            $('#modal-form [name=roa]').attr('disabled', false);
            $('#modal-form [name=roe]').attr('disabled', false);
            $('#modal-form [name=bopo]').attr('disabled', false);
            $('#modal-form [name=nim]').attr('disabled', false);
            $('#modal-form [name=cr]').attr('disabled', false);
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Data Pelaporan Keuangan');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');
    $('#submit-button').text('Update');
    
    $('#modal-form [id=submit-button]').show();
    $('#modal-form [name="posisi_keuangan"]').show();
    $('#modal-form [name="laba_rugi"]').show();
    $('#modal-form [name="kualitas_aset_produktif"]').show();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_input_data]').val(response.tanggal_input_data).attr('disabled', false);
            $('#modal-form [name=periode_tahun]').val(response.periode_tahun).attr('disabled', false);
            $('#modal-form [name=periode_bulan]').val(response.periode_bulan).attr('disabled', false);
            $('#modal-form [name=asset]').val(response.asset).attr('disabled', false);
            $('#modal-form [name=kredit]').val(response.kredit).attr('disabled', false);
            $('#modal-form [name=penempatan_bank_lain]').val(response.penempatan_bank_lain).attr('disabled', false);
            $('#modal-form [name=tabungan]').val(response.tabungan).attr('disabled', false);
            $('#modal-form [name=deposito]').val(response.deposito).attr('disabled', false);
            $('#modal-form [name=pendapatan_operasional]').val(response.pendapatan_operasional).attr('disabled', false);
            $('#modal-form [name=pendapatan_non_operasional]').val(response.pendapatan_non_operasional).attr('disabled', false);
            $('#modal-form [name=biaya_operasional]').val(response.biaya_operasional).attr('disabled', false);
            $('#modal-form [name=biaya_non_operasional]').val(response.biaya_non_operasional).attr('disabled', false);
            $('#modal-form [name=laba_sebelum_pajak]').val(response.laba_sebelum_pajak).attr('disabled', false);
            $('#modal-form [name=pajak]').val(response.pajak).attr('disabled', false);
            $('#modal-form [name=laba_setelah_pajak]').val(response.laba_setelah_pajak).attr('disabled', false);
            $('#modal-form [name=kap]').val(response.kap).attr('disabled', false);
            $('#modal-form [name=kpmm]').val(response.kpmm).attr('disabled', false);
            $('#modal-form [name=npl]').val(response.npl).attr('disabled', false);
            $('#modal-form [name=ppap]').val(response.ppap).attr('disabled', false);
            $('#modal-form [name=ldr]').val(response.ldr).attr('disabled', false);
            $('#modal-form [name=roa]').val(response.roa).attr('disabled', false);
            $('#modal-form [name=roe]').val(response.roe).attr('disabled', false);
            $('#modal-form [name=bopo]').val(response.bopo).attr('disabled', false);
            $('#modal-form [name=nim]').val(response.nim).attr('disabled', false);
            $('#modal-form [name=cr]').val(response.cr).attr('disabled', false);
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function viewForm(url) { 
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Lihat Data Pelaporan Keuangan');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');

    $('#modal-form [id=submit-button]').hide();
    $('#modal-form [name="posisi_keuangan"]').hide();
    $('#modal-form [name="laba_rugi"]').hide();
    $('#modal-form [name="kualitas_aset_produktif"]').hide();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_input_data]').val(response.tanggal_input_data).attr('disabled', true);
            $('#modal-form [name=periode_tahun]').val(response.periode_tahun).attr('disabled', true);
            $('#modal-form [name=periode_bulan]').val(response.periode_bulan).attr('disabled', true);
            $('#modal-form [name=asset]').val(response.asset).attr('disabled', true);
            $('#modal-form [name=kredit]').val(response.kredit).attr('disabled', true);
            $('#modal-form [name=penempatan_bank_lain]').val(response.penempatan_bank_lain).attr('disabled', true);
            $('#modal-form [name=tabungan]').val(response.tabungan).attr('disabled', true);
            $('#modal-form [name=deposito]').val(response.deposito).attr('disabled', true);
            $('#modal-form [name=pendapatan_operasional]').val(response.pendapatan_operasional).attr('disabled', true);
            $('#modal-form [name=pendapatan_non_operasional]').val(response.pendapatan_non_operasional).attr('disabled', true);
            $('#modal-form [name=biaya_operasional]').val(response.biaya_operasional).attr('disabled', true);
            $('#modal-form [name=biaya_non_operasional]').val(response.biaya_non_operasional).attr('disabled', true);
            $('#modal-form [name=laba_sebelum_pajak]').val(response.laba_sebelum_pajak).attr('disabled', true);
            $('#modal-form [name=pajak]').val(response.pajak).attr('disabled', true);
            $('#modal-form [name=laba_setelah_pajak]').val(response.laba_setelah_pajak).attr('disabled', true);
            $('#modal-form [name=kap]').val(response.kap).attr('disabled', true);
            $('#modal-form [name=kpmm]').val(response.kpmm).attr('disabled', true);
            $('#modal-form [name=npl]').val(response.npl).attr('disabled', true);
            $('#modal-form [name=ppap]').val(response.ppap).attr('disabled', true);
            $('#modal-form [name=ldr]').val(response.ldr).attr('disabled', true);
            $('#modal-form [name=roa]').val(response.roa).attr('disabled', true);
            $('#modal-form [name=roe]').val(response.roe).attr('disabled', true);
            $('#modal-form [name=bopo]').val(response.bopo).attr('disabled', true);
            $('#modal-form [name=nim]').val(response.nim).attr('disabled', true);
            $('#modal-form [name=cr]').val(response.cr).attr('disabled', true);
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
