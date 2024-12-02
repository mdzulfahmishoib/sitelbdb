@extends('layouts.master')

@section('title')
    Evaluasi Kinerja Sistem
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">IT</li>
    <li class="breadcrumb-item active">Maintenance</li>
    <li class="breadcrumb-item active">Evaluasi Kinerja Sistem</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            <div class="btn-group">
                @can('create_evaluasi_kinerja_sistem')
                    <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah
                    Data</button>
                @endcan
                @can('kategori_evaluasi_kinerja_sistem')
                    <a href="{{ route('vendor.index') }}" class="btn btn-warning mb-2"><i class="fa fa-list"></i> Kategori Vendor</a>
                @endcan
            </div>
            
            <table id="evaluasi_kinerja_sistem" class="table table-bordered table-striped table-hover table-responsive evaluasi_kinerja_sistem">
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Vendor</th>
                    <th>Keepatuhan Persyaratan Kontrak</th>
                    <th>Keandalan Kualitas Produk / Layanan</th>
                    <th>Ketepatan Waktu Pelayanan</th>
                    <th>Responsif Keluhan</th>
                    <th>Kepuasan Layanan</th>
                    <th>Standar Kualitas Layanan</th>
                    <th>Sumber Daya dan Kualitas</th>
                    <th>Proses Pengujian dan Pengendalian Kualitas</th>
                    <th>Kualitas Laporan</th>
                    <th>Keteresediaan Layanan</th>
                    <th>Tingkat Kegagalan atau Error</th>
                    <th>Waktu Pemulihan dari Gangguan</th>
                    <th>Kepatuhan terhadap Standar BPR</th>
                    <th>Kepatuhan terhadap Persyaratan dan Peraturan</th>
                    <th>Kepatuhan Kode Etik</th>
                    <th>Ketaatan Prinsp Keberlanjutan BCP</th>
                    <th>Kemudahan Berkomunikasi Vendor</th>
                    <th>Tingkat Kerjasama dalam Menyelesaikan Masalah</th>
                    <th>Tingkat Keterbukaan dan Transparansi</th>
                    <th>Kemampuan untuk Memberikan Solusi</th>
                    <th>Kontribusi terhadap Pengembangan Layanan</th>
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

@includeIf('it.maintenance.evaluasi_kinerja_sistem.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#evaluasi_kinerja_sistem").DataTable({
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
                url: '{{ route('evaluasi_kinerja_sistem.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'tanggal_evaluasi_kinerja_sistem' },
                { data: 'id_vendor' },
                { data: 'kepatuhan_kontrak' },
                { data: 'keandalan_kualitas_layanan' },
                { data: 'ketepatan_waktu_pelayanan' },
                { data: 'responsif_keluhan' },
                { data: 'kepuasan_layanan' },
                { data: 'standar_kualitas' },
                { data: 'sumber_daya_kualitas' },
                { data: 'proses_pengujian_pengendalian_kualitas' },
                { data: 'kualitas_laporan' },
                { data: 'ketersediaan_layanan' },
                { data: 'tingkat_kegagalan' },
                { data: 'waktu_pemulihan' },
                { data: 'kepatuhan_standar_bpr' },
                { data: 'kepatuhan_persyaratan' },
                { data: 'kepatuhan_kode_etik' },
                { data: 'kepatuhan_bcp' },
                { data: 'kemudahan_berkomunikasi' },
                { data: 'tingkat_kerjasama' },
                { data: 'tingkat_keterbukaan' },
                { data: 'kemampuan_solusi' },
                { data: 'kontribusi_layanan' },
                {
                    data: 'dokumentasi_db',
                    render: function(data, type, full, meta) {
                        var images = data ? data.split(',') : [];
                        var imageExtensions = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
                        var htmlOutput = images.map(function(file) {
                            var fileExtension = file.split('.').pop().toLowerCase();

                            if (imageExtensions.includes(fileExtension)) {
                                // Jika file adalah gambar, tampilkan gambar
                                return '<img src="{{ asset('storage/it/maintenance/evaluasi_kinerja_sistem') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/it/maintenance/evaluasi_kinerja_sistem') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                { data: 'aksi', searchable: false, sortable: false },
            ],

            "initComplete": function() {
                table.buttons().container().appendTo('#evaluasi_kinerja_sistem_wrapper .col-md-6:eq(0)');
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
        $('#modal-form .modal-title').text('Tambah Data Evaluasi');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_evaluasi_kinerja_sistem]').attr('disabled', false);
            $('#modal-form [name=id_vendor]').attr('disabled', false);
            $('#modal-form [name=kepatuhan_kontrak]').attr('disabled', false);
            $('#modal-form [name=keandalan_kualitas_layanan]').attr('disabled', false);
            $('#modal-form [name=ketepatan_waktu_pelayanan]').attr('disabled', false);
            $('#modal-form [name=responsif_keluhan]').attr('disabled', false);
            $('#modal-form [name=kepuasan_layanan]').attr('disabled', false);
            $('#modal-form [name=standar_kualitas]').attr('disabled', false);
            $('#modal-form [name=sumber_daya_kualitas]').attr('disabled', false);
            $('#modal-form [name=proses_pengujian_pengendalian_kualitas]').attr('disabled', false);
            $('#modal-form [name=kualitas_laporan]').attr('disabled', false);
            $('#modal-form [name=ketersediaan_layanan]').attr('disabled', false);
            $('#modal-form [name=tingkat_kegagalan]').attr('disabled', false);
            $('#modal-form [name=waktu_pemulihan]').attr('disabled', false);
            $('#modal-form [name=kepatuhan_standar_bpr]').attr('disabled', false);
            $('#modal-form [name=kepatuhan_persyaratan]').attr('disabled', false);
            $('#modal-form [name=kepatuhan_kode_etik]').attr('disabled', false);
            $('#modal-form [name=kepatuhan_bcp]').attr('disabled', false);
            $('#modal-form [name=kemudahan_berkomunikasi]').attr('disabled', false);
            $('#modal-form [name=tingkat_kerjasama]').attr('disabled', false);
            $('#modal-form [name=tingkat_keterbukaan]').attr('disabled', false);
            $('#modal-form [name=kemampuan_solusi]').attr('disabled', false);
            $('#modal-form [name=kontribusi_layanan]').attr('disabled', false);

        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Data Evaluasi');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');
    $('#submit-button').text('Update');
    
    $('#modal-form [id=submit-button]').show();
    $('#modal-form [name="dokumentasi[]"]').show();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_evaluasi_kinerja_sistem]').val(response.tanggal_evaluasi_kinerja_sistem).attr('disabled', false);
            $('#modal-form [name=id_vendor]').val(response.id_vendor).attr('disabled', false);
            $('#modal-form [name=kepatuhan_kontrak]').val(response.kepatuhan_kontrak).attr('disabled', false);
            $('#modal-form [name=keandalan_kualitas_layanan]').val(response.keandalan_kualitas_layanan).attr('disabled', false);
            $('#modal-form [name=ketepatan_waktu_pelayanan]').val(response.ketepatan_waktu_pelayanan).attr('disabled', false);
            $('#modal-form [name=responsif_keluhan]').val(response.responsif_keluhan).attr('disabled', false);
            $('#modal-form [name=kepuasan_layanan]').val(response.kepuasan_layanan).attr('disabled', false);
            $('#modal-form [name=standar_kualitas]').val(response.standar_kualitas).attr('disabled', false);
            $('#modal-form [name=sumber_daya_kualitas]').val(response.sumber_daya_kualitas).attr('disabled', false);
            $('#modal-form [name=proses_pengujian_pengendalian_kualitas]').val(response.proses_pengujian_pengendalian_kualitas).attr('disabled', false);
            $('#modal-form [name=kualitas_laporan]').val(response.kualitas_laporan).attr('disabled', false);
            $('#modal-form [name=ketersediaan_layanan]').val(response.ketersediaan_layanan).attr('disabled', false);
            $('#modal-form [name=tingkat_kegagalan]').val(response.tingkat_kegagalan).attr('disabled', false);
            $('#modal-form [name=waktu_pemulihan]').val(response.waktu_pemulihan).attr('disabled', false);
            $('#modal-form [name=kepatuhan_standar_bpr]').val(response.kepatuhan_standar_bpr).attr('disabled', false);
            $('#modal-form [name=kepatuhan_persyaratan]').val(response.kepatuhan_persyaratan).attr('disabled', false);
            $('#modal-form [name=kepatuhan_kode_etik]').val(response.kepatuhan_kode_etik).attr('disabled', false);
            $('#modal-form [name=kepatuhan_bcp]').val(response.kepatuhan_bcp).attr('disabled', false);
            $('#modal-form [name=kemudahan_berkomunikasi]').val(response.kemudahan_berkomunikasi).attr('disabled', false);
            $('#modal-form [name=tingkat_kerjasama]').val(response.tingkat_kerjasama).attr('disabled', false);
            $('#modal-form [name=tingkat_keterbukaan]').val(response.tingkat_keterbukaan).attr('disabled', false);
            $('#modal-form [name=kemampuan_solusi]').val(response.kemampuan_solusi).attr('disabled', false);
            $('#modal-form [name=kontribusi_layanan]').val(response.kontribusi_layanan).attr('disabled', false);
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function viewForm(url) { 
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Lihat Data Evaluasi');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');

    $('#modal-form [id=submit-button]').hide();
    $('#modal-form [name="dokumentasi[]"]').hide();

    $.get(url)
        .done((response) => {;
            $('#modal-form [name=tanggal_evaluasi_kinerja_sistem]').val(response.tanggal_evaluasi_kinerja_sistem).attr('disabled', true);
            $('#modal-form [name=id_vendor]').val(response.id_vendor).attr('disabled', true);
            $('#modal-form [name=kepatuhan_kontrak]').val(response.kepatuhan_kontrak).attr('disabled', true);
            $('#modal-form [name=keandalan_kualitas_layanan]').val(response.keandalan_kualitas_layanan).attr('disabled', true);
            $('#modal-form [name=ketepatan_waktu_pelayanan]').val(response.ketepatan_waktu_pelayanan).attr('disabled', true);
            $('#modal-form [name=responsif_keluhan]').val(response.responsif_keluhan).attr('disabled', true);
            $('#modal-form [name=kepuasan_layanan]').val(response.kepuasan_layanan).attr('disabled', true);
            $('#modal-form [name=standar_kualitas]').val(response.standar_kualitas).attr('disabled', true);
            $('#modal-form [name=sumber_daya_kualitas]').val(response.sumber_daya_kualitas).attr('disabled', true);
            $('#modal-form [name=proses_pengujian_pengendalian_kualitas]').val(response.proses_pengujian_pengendalian_kualitas).attr('disabled', true);
            $('#modal-form [name=kualitas_laporan]').val(response.kualitas_laporan).attr('disabled', true);
            $('#modal-form [name=ketersediaan_layanan]').val(response.ketersediaan_layanan).attr('disabled', true);
            $('#modal-form [name=tingkat_kegagalan]').val(response.tingkat_kegagalan).attr('disabled', true);
            $('#modal-form [name=waktu_pemulihan]').val(response.waktu_pemulihan).attr('disabled', true);
            $('#modal-form [name=kepatuhan_standar_bpr]').val(response.kepatuhan_standar_bpr).attr('disabled', true);
            $('#modal-form [name=kepatuhan_persyaratan]').val(response.kepatuhan_persyaratan).attr('disabled', true);
            $('#modal-form [name=kepatuhan_kode_etik]').val(response.kepatuhan_kode_etik).attr('disabled', true);
            $('#modal-form [name=kepatuhan_bcp]').val(response.kepatuhan_bcp).attr('disabled', true);
            $('#modal-form [name=kemudahan_berkomunikasi]').val(response.kemudahan_berkomunikasi).attr('disabled', true);
            $('#modal-form [name=tingkat_kerjasama]').val(response.tingkat_kerjasama).attr('disabled', true);
            $('#modal-form [name=tingkat_keterbukaan]').val(response.tingkat_keterbukaan).attr('disabled', true);
            $('#modal-form [name=kemampuan_solusi]').val(response.kemampuan_solusi).attr('disabled', true);
            $('#modal-form [name=kontribusi_layanan]').val(response.kontribusi_layanan).attr('disabled', true);
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function cloneForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Clone Data Evaluasi');

        // Reset form
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '{{ route("evaluasi_kinerja_sistem.store") }}'); // Gunakan route store untuk menyimpan data baru
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        // Fetch data from server
        $.get(url)
            .done(function(response) {
                $('#modal-form [name=tanggal_evaluasi_kinerja_sistem]').val(response.tanggal_evaluasi_kinerja_sistem).attr('disabled', false);
                $('#modal-form [name=id_vendor]').val(response.id_vendor).attr('disabled', false);
                $('#modal-form [name=kepatuhan_kontrak]').val(response.kepatuhan_kontrak).attr('disabled', false);
                $('#modal-form [name=keandalan_kualitas_layanan]').val(response.keandalan_kualitas_layanan).attr('disabled', false);
                $('#modal-form [name=ketepatan_waktu_pelayanan]').val(response.ketepatan_waktu_pelayanan).attr('disabled', false);
                $('#modal-form [name=responsif_keluhan]').val(response.responsif_keluhan).attr('disabled', false);
                $('#modal-form [name=kepuasan_layanan]').val(response.kepuasan_layanan).attr('disabled', false);
                $('#modal-form [name=standar_kualitas]').val(response.standar_kualitas).attr('disabled', false);
                $('#modal-form [name=sumber_daya_kualitas]').val(response.sumber_daya_kualitas).attr('disabled', false);
                $('#modal-form [name=proses_pengujian_pengendalian_kualitas]').val(response.proses_pengujian_pengendalian_kualitas).attr('disabled', false);
                $('#modal-form [name=kualitas_laporan]').val(response.kualitas_laporan).attr('disabled', false);
                $('#modal-form [name=ketersediaan_layanan]').val(response.ketersediaan_layanan).attr('disabled', false);
                $('#modal-form [name=tingkat_kegagalan]').val(response.tingkat_kegagalan).attr('disabled', false);
                $('#modal-form [name=waktu_pemulihan]').val(response.waktu_pemulihan).attr('disabled', false);
                $('#modal-form [name=kepatuhan_standar_bpr]').val(response.kepatuhan_standar_bpr).attr('disabled', false);
                $('#modal-form [name=kepatuhan_persyaratan]').val(response.kepatuhan_persyaratan).attr('disabled', false);
                $('#modal-form [name=kepatuhan_kode_etik]').val(response.kepatuhan_kode_etik).attr('disabled', false);
                $('#modal-form [name=kepatuhan_bcp]').val(response.kepatuhan_bcp).attr('disabled', false);
                $('#modal-form [name=kemudahan_berkomunikasi]').val(response.kemudahan_berkomunikasi).attr('disabled', false);
                $('#modal-form [name=tingkat_kerjasama]').val(response.tingkat_kerjasama).attr('disabled', false);
                $('#modal-form [name=tingkat_keterbukaan]').val(response.tingkat_keterbukaan).attr('disabled', false);
                $('#modal-form [name=kemampuan_solusi]').val(response.kemampuan_solusi).attr('disabled', false);
                $('#modal-form [name=kontribusi_layanan]').val(response.kontribusi_layanan).attr('disabled', false);

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
    var fullImageUrl = '{{ asset('storage/it/maintenance/evaluasi_kinerja_sistem') }}/' + imageUrl;
    document.getElementById('modalImage').src = fullImageUrl;
    $('#imageModal').modal('show');
}
</script>

@endpush
