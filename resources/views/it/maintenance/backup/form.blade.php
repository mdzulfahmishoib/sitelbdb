<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 px-4">

                            <!-- Form Objek Backup -->
                            <div class="form-group row">
                                <label for="id_kategori_backup" class="col-md-4 control-label">Objek Backup</label>
                                <div class="col-md-8">
                                    <select name="id_kategori_backup" id="id_kategori_backup" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori_backup as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Form Tanggal -->
                            <div class="form-group row">
                                <label for="tanggal_backup" class="col-md-4 control-label">Tanggal Backup</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_backup" id="tanggal_backup" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Jenis Backup -->
                            <div class="form-group row">
                                <label for="jenis_backup" class="col-md-4 control-label">Jenis Backup</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="jenis_backup" id="jenis_backup" required>
                                        <option value="Online">Online</option>
                                        <option value="Offline">Offline</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Metode Backup -->
                            <div class="form-group row">
                                <label for="metode_backup" class="col-md-4 control-label">Metode Backup</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="metode_backup" id="metode_backup" required>
                                        <option value="Cold">Cold</option>
                                        <option value="Warm">Warm</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Waktu Backup -->
                            <div class="form-group row">
                                <label for="waktu_backup" class="col-md-4 control-label">Waktu Backup</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="waktu_backup" id="waktu_backup" required>
                                        <option value="00">00:00</option>
                                        <option value="21">21:00</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Nama File -->
                            <div class="form-group row">
                                <label for="nama_file_backup" class="col-md-4 control-label">Nama File Backup</label>
                                <div class="col-md-8">
                                    <input type="text" name="nama_file_backup" id="nama_file_backup" class="form-control" readonly>
                                </div>
                            </div>

                        </div>

                        <!-- Kolom 2 -->
                        <div class="col-md-6 px-4">

                            

                            <!-- Form Petugas Backup -->
                            <div class="form-group row">
                                <label for="nama_petugas_backup" class="col-md-4 control-label">Petugas Backup</label>
                                <div class="col-md-8">
                                    <input type="text" name="nama_petugas_backup" id="nama_petugas_backup" class="form-control">
                                </div>
                            </div>

                            <!-- Form Validasi Backup -->
                            <div class="form-group row">
                                <label for="validasi_backup" class="col-md-4 control-label">Validasi Backup</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="validasi_backup" id="validasi_backup" required>
                                        <option value="Belum Diverifikasi">Belum Diverifikasi</option>
                                        <option value="Berhasil">Berhasil</option>
                                        <option value="Tidak Berhasil">Tidak Berhasil</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Nama Petugas Validasi -->
                            <div class="form-group row">
                                <label for="nama_petugas_validasi" class="col-md-4 control-label">Nama Petugas Validasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="nama_petugas_validasi" id="nama_petugas_validasi" class="form-control">
                                </div>
                            </div>

                            <!-- Form Keterangan Backup -->
                            <div class="form-group row">
                                <label for="keterangan_backup" class="col-md-4 control-label">Keterangan Backup</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_backup" name="keterangan_backup" rows="5"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form action="{{ route('backup.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    // Function to format the date and time into the desired file name format
    function updateFileName() {
        const tanggalBackup = document.getElementById('tanggal_backup').value; // Get the date value
        const waktuBackup = document.getElementById('waktu_backup').value; // Get the selected time value

        if (tanggalBackup && waktuBackup) {
            // Convert the date to a usable format (yyyy-mm-dd)
            const dateObj = new Date(tanggalBackup);
            const year = dateObj.getFullYear();
            const month = String(dateObj.getMonth() + 1).padStart(2, '0'); // Ensure two digits
            const day = String(dateObj.getDate()).padStart(2, '0'); // Ensure two digits

            // Construct the file name
            const fileName = `bojonegoro_system_${year}-${month}-${day}_${waktuBackup}.sql.gz`;

            // Set the value to the input field with id="nama_file_backup"
            document.getElementById('nama_file_backup').value = fileName;
        }
    }

    // Add event listeners to trigger the function when date or time is changed
    document.getElementById('tanggal_backup').addEventListener('change', updateFileName);
    document.getElementById('waktu_backup').addEventListener('change', updateFileName);
</script>

