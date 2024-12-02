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

                            <!-- Form Jenis Pelaporan -->
                            <div class="form-group mb-4">
                                <label for="jenis_pelaporan" class="control-label">Jenis Pelaporan</label>
                                <div>
                                    <select class="form-control" name="jenis_pelaporan" id="jenis_pelaporan" required>
                                        <option value="INTERNAL">INTERNAL</option>
                                        <option value="EKSTERNAL">EKSTERNAL</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Pihak Menerima -->
                            <div class="form-group mb-4">
                                <label for="pihak_menerima" class="control-label">Pihak Menerima</label>
                                <div>
                                    <input type="text" name="pihak_menerima" id="pihak_menerima" class="form-control">
                                </div>
                            </div>

                            <!-- Form Perihal Laporan -->
                            <div class="form-group mb-4">
                                <label for="perihal_laporan" class="control-label">Perihal Laporan</label>
                                <div>
                                    <input type="text" name="perihal_laporan" id="perihal_laporan" class="form-control">
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
                    <form id="pelaporan_isidentil-form" action="{{ route('pelaporan_isidentil.store') }}" method="POST" enctype="multipart/form-data">
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