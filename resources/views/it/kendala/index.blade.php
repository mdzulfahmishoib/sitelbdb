@extends('layouts.master')

@section('title')
    Kendala/Problem
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">IT / Kendala atau Problem</li>
@endsection

@section('content')

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-body">
            @can('create_kendala')
            <button onclick="addForm()" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Tambah
                Data</button>
            @endcan
            <table id="kendala" class="table table-bordered table-striped table-hover table-responsive kendala">
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Urgensi</th>
                    <th>Klasifikasi</th>
                    <th>Keterangan Kendala</th>
                    <th>Pelapor</th>
                    <th>Kantor</th>
                    <th>Unit/Bagian</th>
                    <th>Diselesaikan Oleh</th>
                    <th>Status</th>
                    <th>Tgl Selesai</th>
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

@includeIf('it.kendala.form')
@endsection

<!-- Untuk meload script datatable pada elemen <table> -->
@push('script')
<script>
var table;

    $(function () {
        table = $("#kendala").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "columnDefs": [
                { targets: [2, 3, 6, 7, 8], visible: false },
                { "width": "100px", "targets": 1 },
                { "width": "250px", "targets": 11 },
                { "width": "230px", "targets": 4 },
                { "width": "100px", "targets": 10 },
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
                url: '{{ route('kendala.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex' },
                { data: 'tanggal_kendala' },
                { data: 'urgensi' },
                { data: 'klasifikasi' },
                { data: 'keterangan_kendala' },
                { data: 'pelapor' },
                { data: 'nama_kantor' },
                { data: 'nama_unit_bagian' },
                { data: 'diselesaikan_oleh' },
                { data: 'status' },
                { data: 'tanggal_selesai' },
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
                                return '<img src="{{ asset('storage/it/kendala') }}/' + file + '" height="50" class="mb-1" title="Dokumentasi" style="cursor:pointer;" onclick="showImageModal(\'' + file + '\')"/>';
                            } else {
                                // Jika file bukan gambar, tampilkan tombol download
                                return '<a href="{{ asset('storage/it/kendala') }}/' + file + '" class="btn btn-primary" title="Download">Download</a>';
                            }
                        }).join(' ');

                        return htmlOutput;
                    }
                },
                { data: 'aksi', searchable: false, sortable: false },
            ],

            "initComplete": function() {
                table.buttons().container().appendTo('#kendala_wrapper .col-md-6:eq(0)');
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
        $('#modal-form .modal-title').text('Tambah Data Kendala');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '');
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        $('#modal-form [id=submit-button]').show();
        $('#modal-form [name="dokumentasi[]"]').show();

        $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_kendala]').attr('disabled', false);
            $('#modal-form [name=urgensi]').attr('disabled', false);
            $('#modal-form [name=klasifikasi]').attr('disabled', false);
            $('#modal-form [name=keterangan_kendala]').attr('disabled', false);
            $('#modal-form [name=pelapor]').attr('disabled', false);
            $('#modal-form [name=id_kantor]').attr('disabled', false);
            $('#modal-form [name=id_unit_bagian]').attr('disabled', false);
            $('#modal-form [name=diselesaikan_oleh]').attr('disabled', false);
            $('#modal-form [name=status]').attr('disabled', false);
            $('#modal-form [name=tanggal_selesai]').attr('disabled', false);
            $('#modal-form [name=keterangan_tambahan]').attr('disabled', false);
            // No need to fill file inputs
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Data Kendala');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');
    $('#submit-button').text('Update');
    
    $('#modal-form [id=submit-button]').show();
    $('#modal-form [name="dokumentasi[]"]').show();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_kendala]').val(response.tanggal_kendala).attr('disabled', false);
            $('#modal-form [name=urgensi]').val(response.urgensi).attr('disabled', false);
            $('#modal-form [name=klasifikasi]').val(response.klasifikasi).attr('disabled', false);
            $('#modal-form [name=keterangan_kendala]').val(response.keterangan_kendala).attr('disabled', false);
            $('#modal-form [name=pelapor]').val(response.pelapor).attr('disabled', false);
            $('#modal-form [name=id_kantor]').val(response.id_kantor).attr('disabled', false);
            $('#modal-form [name=id_unit_bagian]').val(response.id_unit_bagian).attr('disabled', false);
            $('#modal-form [name=diselesaikan_oleh]').val(response.diselesaikan_oleh).attr('disabled', false);
            $('#modal-form [name=status]').val(response.status).attr('disabled', false);
            $('#modal-form [name=tanggal_selesai]').val(response.tanggal_selesai).attr('disabled', false);
            $('#modal-form [name=keterangan_tambahan]').val(response.keterangan_tambahan).attr('disabled', false);
            // No need to fill file inputs
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function viewForm(url) { 
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Lihat Data Kendala');

    $('#modal-form form')[0].reset();
    $('#modal-form form').attr('action', url);
    $('#form-method').val('PUT');

    $('#modal-form [id=submit-button]').hide();
    $('#modal-form [name="dokumentasi[]"]').hide();

    $.get(url)
        .done((response) => {
            $('#modal-form [name=tanggal_kendala]').val(response.tanggal_kendala).attr('disabled', true);
            $('#modal-form [name=urgensi]').val(response.urgensi).attr('disabled', true);
            $('#modal-form [name=klasifikasi]').val(response.klasifikasi).attr('disabled', true);
            $('#modal-form [name=keterangan_kendala]').val(response.keterangan_kendala).attr('disabled', true);
            $('#modal-form [name=pelapor]').val(response.pelapor).attr('disabled', true);
            $('#modal-form [name=id_kantor]').val(response.id_kantor).attr('disabled', true);
            $('#modal-form [name=id_unit_bagian]').val(response.id_unit_bagian).attr('disabled', true);
            $('#modal-form [name=diselesaikan_oleh]').val(response.diselesaikan_oleh).attr('disabled', true);
            $('#modal-form [name=status]').val(response.status).attr('disabled', true);
            $('#modal-form [name=tanggal_selesai]').val(response.tanggal_selesai).attr('disabled', true);
            $('#modal-form [name=keterangan_tambahan]').val(response.keterangan_tambahan).attr('disabled', true);
            $('#modal-form [name=user_name]').val(response.user_name).attr('disabled', true);
            // No need to fill file inputs
        })
        .fail((errors) => {
            alert('Cannot display data');
        });
    }

    function cloneForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Clone Data Kendala');

        // Reset form
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', '{{ route("kendala.store") }}'); // Gunakan route store untuk menyimpan data baru
        $('#form-method').val('POST');
        $('#submit-button').text('Simpan');

        // Fetch data from server
        $.get(url)
            .done(function(response) {
                // Isi form dengan data yang didapat
                $('#modal-form [name=tanggal_kendala]').val(response.tanggal_kendala).attr('disabled', false);
                $('#modal-form [name=urgensi]').val(response.urgensi).attr('disabled', false);
                $('#modal-form [name=klasifikasi]').val(response.klasifikasi).attr('disabled', false);
                $('#modal-form [name=keterangan_kendala]').val(response.keterangan_kendala).attr('disabled', false);
                $('#modal-form [name=pelapor]').val(response.pelapor).attr('disabled', false);
                $('#modal-form [name=id_kantor]').val(response.id_kantor).attr('disabled', false);
                $('#modal-form [name=id_unit_bagian]').val(response.id_unit_bagian).attr('disabled', false);
                $('#modal-form [name=diselesaikan_oleh]').val(response.diselesaikan_oleh).attr('disabled', false);
                $('#modal-form [name=status]').val(response.status).attr('disabled', false);
                $('#modal-form [name=tanggal_selesai]').val(response.tanggal_selesai).attr('disabled', false);
                $('#modal-form [name=keterangan_tambahan]').val(response.keterangan_tambahan).attr('disabled', false);
                // Tidak mengisi input file karena ini data baru
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
    var fullImageUrl = '{{ asset('storage/it/kendala') }}/' + imageUrl;
    document.getElementById('modalImage').src = fullImageUrl;
    $('#imageModal').modal('show');
}
</script>

@endpush