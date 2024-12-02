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
                                    <select class="form-control" name="periode_tahun" id="periode_tahun" required>
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


                            <!-- Form Periode Bulan -->
                            <div class="form-group mb-4">
                                <label for="periode_bulan" class="control-label">Periode Bulan</label>
                                <div>
                                    <select class="form-control" name="periode_bulan" id="periode_bulan" required>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Asset -->
                            <div class="form-group mb-4">
                                <label for="asset" class="control-label">Asset</label>
                                <div>
                                    <input type="text" name="asset" id="asset" class="form-control">
                                </div>
                            </div>

                            <!-- Form Kredit Yang Diberikan -->
                            <div class="form-group mb-4">
                                <label for="kredit" class="control-label">Kredit Yang Diberikan</label>
                                <div>
                                    <input type="text" name="kredit" id="kredit" class="form-control">
                                </div>
                            </div>

                            <!-- Form Penempatan Pada Bank Lain -->
                            <div class="form-group mb-4">
                                <label for="penempatan_bank_lain" class="control-label">Penempatan Pada Bank Lain</label>
                                <div>
                                    <input type="text" name="penempatan_bank_lain" id="penempatan_bank_lain" class="form-control">
                                </div>
                            </div>

                            <!-- Form Tabungan -->
                            <div class="form-group mb-4">
                                <label for="tabungan" class="control-label">Tabungan</label>
                                <div>
                                    <input type="text" name="tabungan" id="tabungan" class="form-control">
                                </div>
                            </div>

                            <!-- Form Deposito -->
                            <div class="form-group mb-4">
                                <label for="deposito" class="control-label">Deposito</label>
                                <div>
                                    <input type="text" name="deposito" id="deposito" class="form-control">
                                </div>
                            </div>

                            <!-- Form Pendapatan Operasional -->
                            <div class="form-group mb-4">
                                <label for="pendapatan_operasional" class="control-label">Pendapatan Operasional</label>
                                <div>
                                    <input type="text" name="pendapatan_operasional" id="pendapatan_operasional" class="form-control">
                                </div>
                            </div>

                            <!-- Form Pendapatan Non Operasional -->
                            <div class="form-group mb-4">
                                <label for="pendapatan_non_operasional" class="control-label">Pendapatan Non Operasional</label>
                                <div>
                                    <input type="text" name="pendapatan_non_operasional" id="pendapatan_non_operasional" class="form-control">
                                </div>
                            </div>

                            <!-- Form Biaya Operasional -->
                            <div class="form-group mb-4">
                                <label for="biaya_operasional" class="control-label">Biaya Operasional</label>
                                <div>
                                    <input type="text" name="biaya_operasional" id="biaya_operasional" class="form-control">
                                </div>
                            </div>

                            <!-- Form Biaya Non Operasional -->
                            <div class="form-group mb-4">
                                <label for="biaya_non_operasional" class="control-label">Biaya Non Operasional</label>
                                <div>
                                    <input type="text" name="biaya_non_operasional" id="biaya_non_operasional" class="form-control">
                                </div>
                            </div>

                            <!-- Form Laba Sebelum Pajak -->
                            <div class="form-group mb-4">
                                <label for="laba_sebelum_pajak" class="control-label">Laba Sebelum Pajak</label>
                                <div>
                                    <input type="text" name="laba_sebelum_pajak" id="laba_sebelum_pajak" class="form-control">
                                </div>
                            </div>

                            <!-- Form Pajak -->
                            <div class="form-group mb-4">
                                <label for="pajak" class="control-label">Pajak</label>
                                <div>
                                    <input type="text" name="pajak" id="pajak" class="form-control">
                                </div>
                            </div>

                            <!-- Form Laba Setelah Pajak -->
                            <div class="form-group mb-4">
                                <label for="laba_setelah_pajak" class="control-label">Laba Setelah Pajak</label>
                                <div>
                                    <input type="text" name="laba_setelah_pajak" id="laba_setelah_pajak" class="form-control">
                                </div>
                            </div>

                            <!-- Form KAP -->
                            <div class="form-group mb-4">
                                <label for="kap" class="control-label">KAP</label>
                                <div>
                                    <input type="text" name="kap" id="kap" class="form-control">
                                </div>
                            </div>

                            <!-- Form KPMM / CAR -->
                            <div class="form-group mb-4">
                                <label for="kpmm" class="control-label">KPMM / CAR</label>
                                <div class="input-group">
                                    <input type="text" name="kpmm" id="kpmm" class="form-control">
                                </div>
                            </div>

                            <!-- Form NPL Netto -->
                            <div class="form-group mb-4">
                                <label for="npl" class="control-label">NPL Netto</label>
                                <div class="input-group">
                                    <input type="text" name="npl" id="npl" class="form-control">
                                </div>
                            </div>

                            <!-- Form PPAP -->
                            <div class="form-group mb-4">
                                <label for="ppap" class="control-label">PPAP</label>
                                <div class="input-group">
                                    <input type="text" name="ppap" id="ppap" class="form-control">
                                </div>
                            </div>

                            <!-- Form LDR -->
                            <div class="form-group mb-4">
                                <label for="ldr" class="control-label">LDR</label>
                                <div class="input-group">
                                    <input type="text" name="ldr" id="ldr" class="form-control">
                                </div>
                            </div>

                            <!-- Form ROA -->
                            <div class="form-group mb-4">
                                <label for="roa" class="control-label">ROA</label>
                                <div class="input-group">
                                    <input type="text" name="roa" id="roa" class="form-control">
                                </div>
                            </div>

                            <!-- Form ROE -->
                            <div class="form-group mb-4">
                                <label for="roe" class="control-label">ROE</label>
                                <div class="input-group">
                                    <input type="text" name="roe" id="roe" class="form-control">
                                </div>
                            </div>
                            
                            <!-- Form BOPO -->
                            <div class="form-group mb-4">
                                <label for="bopo" class="control-label">BOPO</label>
                                <div class="input-group">
                                    <input type="text" name="bopo" id="bopo" class="form-control">
                                </div>
                            </div>

                            <!-- Form NIM -->
                            <div class="form-group mb-4">
                                <label for="nim" class="control-label">NIM</label>
                                <div class="input-group">
                                    <input type="text" name="nim" id="nim" class="form-control">
                                </div>
                            </div>

                            <!-- Form CR -->
                            <div class="form-group mb-4">
                                <label for="cr" class="control-label">CR</label>
                                <div class="input-group">
                                    <input type="text" name="cr" id="cr" class="form-control">
                                </div>
                            </div>

                            <!-- Form Lap. Posisi Keuangan -->
                            <div class="form-group mb-4">
                                <label for="posisi_keuangan" name="posisi_keuangan" class="control-label">Lap. Posisi Keuangan</label>
                                <div>
                                    <input type="file" class="form-control" id="posisi_keuangan" name="posisi_keuangan">
                                </div>
                            </div>

                            <!-- Form Lap. Laba Rugi -->
                            <div class="form-group mb-4">
                                <label for="laba_rugi" name="laba_rugi" class="control-label">Lap. Laba Rugi</label>
                                <div>
                                    <input type="file" class="form-control" id="laba_rugi" name="laba_rugi">
                                </div>
                            </div>

                            <!-- Form Lap. Kualitas Aset Produktif -->
                            <div class="form-group mb-4">
                                <label for="kualitas_aset_produktif" name="kualitas_aset_produktif" class="control-label">Lap. Kualitas Aset Produktif</label>
                                <div>
                                    <input type="file" class="form-control" id="kualitas_aset_produktif" name="kualitas_aset_produktif">
                                </div>
                            </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form id="pelaporan_keuangan-form" action="{{ route('pelaporan_keuangan.store') }}" method="POST" enctype="multipart/form-data">
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
    // Daftar ID input yang memerlukan penambahan simbol %
    const percentageFields = ['kap', 'kpmm', 'npl', 'ppap', 'ldr', 'roa', 'roe', 'bopo', 'nim', 'cr'];

    // Fungsi untuk menambahkan % otomatis
    function addPercentageSymbol(fieldId) {
        const field = document.getElementById(fieldId);

        field.addEventListener('input', function() {
            let value = field.value.replace('%', '');
            
            // Tambahkan % hanya jika input adalah angka dan bukan kosong
            if (!isNaN(value) && value.trim() !== '') {
                field.value = `${value}%`;
            } else {
                field.value = ''; // Kosongkan jika input tidak valid
            }
        });
    }

    // Menambahkan listener ke setiap field yang membutuhkan %
    percentageFields.forEach(addPercentageSymbol);
</script>