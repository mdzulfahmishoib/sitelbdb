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
                            <!-- Form Tanggal -->
                            <div class="form-group row">
                                <label for="tanggal_pengecekan_suhu" class="col-md-4 control-label">Tanggal Pengecekan</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_pengecekan_suhu" id="tanggal_pengecekan_suhu" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Waktu Pengecekan -->
                            <div class="form-group row">
                                <label for="waktu_pagi" class="col-md-4 control-label">Waktu Pengecekan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="waktu_pagi" id="waktu_pagi" readonly value="Pagi">
                                </div>
                            </div>

                            <!-- Form Suhu -->
                            <div class="form-group row">
                                <label for="suhu_pagi" class="col-md-4 control-label">Suhu</label>
                                <div class="col-md-8">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="suhu_pagi" id="suhu_pagi" placeholder="Ditulis angka" required>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">°C</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Kondisi -->
                            <div class="form-group row">
                                <label for="kondisi_pagi" class="col-md-4 control-label">Kondisi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="kondisi_pagi" id="kondisi_pagi" readonly>
                                </div>
                            </div>

                            <!-- Form Keterangan Tambahan -->
                            <div class="form-group row">
                                <label for="keterangan_tambahan_pagi" class="col-md-4 control-label">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_tambahan_pagi" name="keterangan_tambahan_pagi" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- Form Dicek Oleh -->
                            <div class="form-group row">
                                <label for="dicek_oleh" class="col-md-4 control-label">Dicek Oleh</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="dicek_oleh" id="dicek_oleh" required>
                                </div>
                            </div>

                        </div>

                        <!-- Kolom 2 -->
                        <div class="col-md-6 px-4">

                            <!-- Form Waktu Pengecekan -->
                            <div class="form-group row">
                                <label for="waktu_sore" class="col-md-4 control-label">Waktu Pengecekan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="waktu_sore" id="waktu_sore" readonly value="Sore">
                                </div>
                            </div>

                            <!-- Form Suhu -->
                            <div class="form-group row">
                                <label for="suhu_sore" class="col-md-4 control-label">Suhu</label>
                                <div class="col-md-8">
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="suhu_sore" id="suhu_sore" placeholder="Ditulis angka">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">°C</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Kondisi -->
                            <div class="form-group row">
                                <label for="kondisi_sore" class="col-md-4 control-label">Kondisi</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="kondisi_sore" id="kondisi_sore" readonly>
                                </div>
                            </div>

                            <!-- Form Kesimpulan -->
                            <div class="form-group row">
                                <label for="kesimpulan" class="col-md-4 control-label">Kesimpulan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="kesimpulan" id="kesimpulan" readonly>
                                </div>
                            </div>

                            <!-- Form Keterangan Tambahan -->
                            <div class="form-group row">
                                <label for="keterangan_tambahan_sore" class="col-md-4 control-label">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_tambahan_sore" name="keterangan_tambahan_sore" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- Form Dokumentasi -->
                            <div class="form-group row">
                                <label for="dokumentasi" name="dokumentasi[]" class="col-md-4 control-label">Dokumentasi</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="dokumentasi" name="dokumentasi[]" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form action="{{ route('pengecekan_suhu.store') }}" method="POST" enctype="multipart/form-data">
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
    document.addEventListener('DOMContentLoaded', (event) => {
        const suhuPagiInput = document.getElementById('suhu_pagi');
        const kondisiPagiInput = document.getElementById('kondisi_pagi');
        const suhuSoreInput = document.getElementById('suhu_sore');
        const kondisiSoreInput = document.getElementById('kondisi_sore');
        const kesimpulanInput = document.getElementById('kesimpulan');

        // Function to update 'kondisi_pagi' based on 'suhu_pagi'
        function updateKondisiPagi() {
            const suhuValue = parseFloat(suhuPagiInput.value);

            if (suhuValue <= 16) {
                kondisiPagiInput.value = 'Cek Temperatur';
            } else if (suhuValue >= 17 && suhuValue <= 27) {
                kondisiPagiInput.value = 'Normal';
            } else if (suhuValue >= 28 && suhuValue <= 32) {
                kondisiPagiInput.value = 'Peringatan';
            } else if (suhuValue > 32) {
                kondisiPagiInput.value = 'Bahaya';
            } else {
                kondisiPagiInput.value = ''; // Handle other cases if needed
            }
        }

        // Function to update 'kondisi_sore' based on 'suhu_sore'
        function updateKondisiSore() {
            const suhuValue = parseFloat(suhuSoreInput.value);

            if (suhuValue <= 16) {
                kondisiSoreInput.value = 'Cek Temperatur';
            } else if (suhuValue >= 17 && suhuValue <= 27) {
                kondisiSoreInput.value = 'Normal';
            } else if (suhuValue >= 28 && suhuValue <= 32) {
                kondisiSoreInput.value = 'Peringatan';
            } else if (suhuValue > 32) {
                kondisiSoreInput.value = 'Bahaya';
            } else {
                kondisiSoreInput.value = ''; // Handle other cases if needed
            }
        }

        // Function to update 'kesimpulan' based on 'kondisi_pagi' and 'kondisi_sore'
        function updateKesimpulan() {
            const kondisiPagi = kondisiPagiInput.value.trim().toLowerCase();
            const kondisiSore = kondisiSoreInput.value.trim().toLowerCase();

            if (kondisiPagi === 'normal' && kondisiSore === 'normal') {
                kesimpulanInput.value = 'Keadaan Normal';
            } else if ((kondisiPagi === 'normal' && (kondisiSore === 'peringatan' || kondisiSore === 'bahaya')) ||
                       (kondisiSore === 'normal' && (kondisiPagi === 'peringatan' || kondisiPagi === 'bahaya'))) {
                kesimpulanInput.value = 'Ada Kendala';
            } else if ((kondisiPagi === 'normal' && kondisiSore === 'bahaya') ||
                       (kondisiPagi === 'peringatan' && kondisiSore === 'peringatan')) {
                kesimpulanInput.value = 'Ada Kendala Berbahaya';
            } else if ((kondisiPagi === 'peringatan' && kondisiSore === 'bahaya') ||
                       (kondisiPagi === 'bahaya' && kondisiSore === 'peringatan')) {
                kesimpulanInput.value = 'Ada Kendala Serius';
            } else if (kondisiPagi === 'bahaya' && kondisiSore === 'bahaya') {
                kesimpulanInput.value = 'Keadaan Sangat Berbahaya';
            } else {
                kesimpulanInput.value = 'Masih Ada Yang Kosong';
            }
        }

        // Event listeners to update on input change
        suhuPagiInput.addEventListener('input', () => {
            updateKondisiPagi();
            updateKesimpulan();
        });

        suhuSoreInput.addEventListener('input', () => {
            updateKondisiSore();
            updateKesimpulan();
        });

        kondisiPagiInput.addEventListener('input', () => {
            updateKesimpulan();
        });

        kondisiSoreInput.addEventListener('input', () => {
            updateKesimpulan();
        });
    });
</script>
