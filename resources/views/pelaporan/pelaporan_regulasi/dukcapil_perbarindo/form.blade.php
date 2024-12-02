<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-md" role="document">
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
                            <!-- Form Tanggal -->
                            <div class="form-group mb-4">
                                <label for="tanggal_input_data" class="control-label">Tanggal Input Data</label>
                                <div>
                                    <input type="date" name="tanggal_input_data" id="tanggal_input_data" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Periode Tahun -->
                            <div class="form-group mb-4">
                                <label for="periode_tahun" class="control-label">Periode Tahun</label>
                                <div>
                                    <select class="form-control" name="periode_tahun" id="periode_tahun">
                                        <?php 
                                            $currentYear = date("Y");
                                            for ($i = -1; $i <= 7; $i++) { // Mulai dari -1 untuk tahun sebelumnya, hingga 7 tahun setelahnya
                                                $year = $currentYear + $i;
                                                echo "<option value=\"$year\">$year</option>";
                                            }
                                        ?>
                                    </select>                                    
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="jenis_periode">Jenis Periode</label>
                                <select id="jenis_periode" class="form-control" name="jenis_periode">
                                    <option value="">-- Pilih Jenis Periode --</option>
                                    <option value="Bulanan">Bulanan</option>
                                    <option value="Semester">Semester</option>
                                    <option value="Isidentil">Isidentil</option>
                                </select>
                            </div>
                            
                            <div id="nama_laporan" class="form-group mb-4">
                                <label for="nama_laporan" name="nama_laporan">Nama Laporan</label>
                                <select id="nama_laporan" name="nama_laporan" class="form-control">
                                    <option value="">Pilih Nama Laporan</option>
                                </select>
                            </div>

                            <p>
                                <a class="btn btn-primary" data-toggle="collapse" href="#collapseIsidentil" role="button" aria-expanded="false" aria-controls="collapseIsidentil">
                                <i class="fas fa-plus-circle"></i> Laporan Isidentil
                                </a>
                            </p>
                            <div class="collapse mb-4 bg-light" id="collapseIsidentil">
                                <div class="card-body border">
                                    <div id="nama_laporan_isidentil" class="form-group mb-2">
                                        <label for="nama_laporan_isidentil">Nama Laporan Isidentil</label>
                                        <input type="text" name="nama_laporan_isidentil" id="nama_laporan_isidentil" class="form-control" placeholder="Masukkan nama laporan isidentil">
                                    </div>   
                                          
                                </div>
                            </div>
                                                                                
                            <!-- Form Dokumen Pendukung -->
                            <div class="form-group mb-4">
                                <label for="dokumen_pendukung_up" name="dokumen_pendukung_up" class="control-label">Dokumen Pendukung</label>
                                <div>
                                    <input type="file" class="form-control" id="dokumen_pendukung_up" name="dokumen_pendukung_up">
                                </div>
                            </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form id="pelaporan_dukcapil_perbarindo-form" action="{{ route('pelaporan_dukcapil_perbarindo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button" name="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    document.getElementById('jenis_periode').addEventListener('change', function () {
        const jenisPeriode = this.value; // Mendapatkan nilai dari select jenis_periode
        const namaLaporan = document.getElementById('nama_laporan').querySelector('select'); // Akses ke select nama_laporan
        const collapseIsidentil = document.getElementById('collapseIsidentil'); // Akses ke elemen collapseIsidentil

        // Daftar opsi untuk setiap jenis periode
        const options = {
            Bulanan: [
                { value: 'Laporan Data Balikan ke DUKCAPIL kirim Email', text: 'Laporan Data Balikan ke DUKCAPIL kirim Email' },
            ],
            Semester: [
                { value: 'Laporan Semester I ke DUKCAPIL', text: 'Laporan Semester I ke DUKCAPIL' },
                { value: 'Laporan Semester II ke DUKCAPIL', text: 'Laporan Semester II ke DUKCAPIL' },
            ],
        };

        // Hapus semua opsi lama, kecuali placeholder
        namaLaporan.innerHTML = '<option value="">Pilih Nama Laporan</option>';

        // Tambahkan opsi baru berdasarkan jenis periode yang dipilih
        if (options[jenisPeriode]) {
            options[jenisPeriode].forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.textContent = opt.text;
                namaLaporan.appendChild(option);
            });
        }

        // Logika untuk membuka/menutup collapse ketika memilih "Isidentil"
        if (jenisPeriode === 'Isidentil') {
            // Membuka collapse
            collapseIsidentil.classList.add('show');
        } else {
            // Menutup collapse jika opsi lain dipilih
            collapseIsidentil.classList.remove('show');
        }
    });
</script>

