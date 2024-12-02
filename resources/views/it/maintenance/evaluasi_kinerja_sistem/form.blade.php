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
                                <label for="tanggal_evaluasi_kinerja_sistem" class="control-label">Tanggal Evaluasi</label>
                                <div>
                                    <input type="date" name="tanggal_evaluasi_kinerja_sistem" id="tanggal_evaluasi_kinerja_sistem" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Vendor -->
                            <div class="form-group mb-4">
                                <label for="id_vendor" class="control-label">Vendor</label>
                                <div>
                                    <select class="form-control" name="id_vendor" id="id_vendor" required>
                                        <option value="">Pilih Vendor</option>
                                        @foreach ($vendor as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kepatuhan terhadap Persyaratan Kontrak -->
                            <div class="form-group mb-4">
                                <label for="kepatuhan_kontrak" class="control-label">Kepatuhan terhadap Persyaratan Kontrak</label>
                                <div>
                                    <select class="form-control" name="kepatuhan_kontrak" id="kepatuhan_kontrak">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kehandalan dan Kualitas Produk atau Layanan yang Disediakan -->
                            <div class="form-group mb-4">
                                <label for="keandalan_kualitas_layanan" class="control-label">Kehandalan dan Kualitas Produk atau Layanan yang Disediakan</label>
                                <div>
                                    <select class="form-control" name="keandalan_kualitas_layanan" id="keandalan_kualitas_layanan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Ketepatan Waktu Pengiriman atau Pelayanan -->
                            <div class="form-group mb-4">
                                <label for="ketepatan_waktu_pelayanan" class="control-label">Ketepatan Waktu Pengiriman atau Pelayanan</label>
                                <div>
                                    <select class="form-control" name="ketepatan_waktu_pelayanan" id="ketepatan_waktu_pelayanan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Responsif terhadap Permintaan atau Keluhan -->
                            <div class="form-group mb-4">
                                <label for="responsif_keluhan" class="control-label">Responsif terhadap Permintaan atau Keluhan</label>
                                <div>
                                    <select class="form-control" name="responsif_keluhan" id="responsif_keluhan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kepuasan dengan Produk atau Layanan -->
                            <div class="form-group mb-4">
                                <label for="kepuasan_layanan" class="control-label">Kepuasan dengan Produk atau Layanan</label>
                                <div>
                                    <select class="form-control" name="kepuasan_layanan" id="kepuasan_layanan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Standar Kualitas Produk atau Layanan -->
                            <div class="form-group mb-4">
                                <label for="standar_kualitas" class="control-label">Standar Kualitas Produk atau Layanan</label>
                                <div>
                                    <select class="form-control" name="standar_kualitas" id="standar_kualitas">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Sumber Daya dan Kualitas -->
                            <div class="form-group mb-4">
                                <label for="sumber_daya_kualitas" class="control-label">Sumber Daya dan Kualitas</label>
                                <div>
                                    <select class="form-control" name="sumber_daya_kualitas" id="sumber_daya_kualitas">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Proses Pengujian dan Pengendalian Kualitas -->
                            <div class="form-group mb-4">
                                <label for="proses_pengujian_pengendalian_kualitas" class="control-label">Proses Pengujian dan Pengendalian Kualitas</label>
                                <div>
                                    <select class="form-control" name="proses_pengujian_pengendalian_kualitas" id="proses_pengujian_pengendalian_kualitas">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kualitas Laporan -->
                            <div class="form-group mb-4">
                                <label for="kualitas_laporan" class="control-label">Kualitas Laporan</label>
                                <div>
                                    <select class="form-control" name="kualitas_laporan" id="kualitas_laporan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Ketersediaan Produk atau Layanan -->
                            <div class="form-group mb-4">
                                <label for="ketersediaan_layanan" class="control-label">Ketersediaan Produk atau Layanan</label>
                                <div>
                                    <select class="form-control" name="ketersediaan_layanan" id="ketersediaan_layanan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Tingkat Kegagalan atau Error -->
                            <div class="form-group mb-4">
                                <label for="tingkat_kegagalan" class="control-label">Tingkat Kegagalan atau Error</label>
                                <div>
                                    <select class="form-control" name="tingkat_kegagalan" id="tingkat_kegagalan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Waktu Pemulihan dari Gangguan atau Kegagalan -->
                            <div class="form-group mb-4">
                                <label for="waktu_pemulihan" class="control-label">Waktu Pemulihan dari Gangguan atau Kegagalan</label>
                                <div>
                                    <select class="form-control" name="waktu_pemulihan" id="waktu_pemulihan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kepatuhan terhadap Peraturan dan Standar BPR -->
                            <div class="form-group mb-4">
                                <label for="kepatuhan_standar_bpr" class="control-label">Kepatuhan terhadap Peraturan dan Standar BPR</label>
                                <div>
                                    <select class="form-control" name="kepatuhan_standar_bpr" id="kepatuhan_standar_bpr">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kepatuhan terhadap Persyaratan dan Peraturan -->
                            <div class="form-group mb-4">
                                <label for="kepatuhan_persyaratan" class="control-label">Kepatuhan terhadap Persyaratan dan Peraturan</label>
                                <div>
                                    <select class="form-control" name="kepatuhan_persyaratan" id="kepatuhan_persyaratan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kepatuhan terhadap Kode Etik Bisnis -->
                            <div class="form-group mb-4">
                                <label for="kepatuhan_kode_etik" class="control-label">Kepatuhan terhadap Kode Etik Bisnis</label>
                                <div>
                                    <select class="form-control" name="kepatuhan_kode_etik" id="kepatuhan_kode_etik">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Ketaatan terhadap Prinsip-prinsip Keberlanjutan (BCP) -->
                            <div class="form-group mb-4">
                                <label for="kepatuhan_bcp" class="control-label">Ketaatan terhadap Prinsip-prinsip Keberlanjutan (BCP)</label>
                                <div>
                                    <select class="form-control" name="kepatuhan_bcp" id="kepatuhan_bcp">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kemudahan Berkomunikasi dengan Pihak Ketiga atau Vendor -->
                            <div class="form-group mb-4">
                                <label for="kemudahan_berkomunikasi" class="control-label">Kemudahan Berkomunikasi dengan Pihak Ketiga atau Vendor</label>
                                <div>
                                    <select class="form-control" name="kemudahan_berkomunikasi" id="kemudahan_berkomunikasi">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Tingkat Kerjasama dalam Menyelesaikan Masalah atau Proyek Bersama -->
                            <div class="form-group mb-4">
                                <label for="tingkat_kerjasama" class="control-label">Tingkat Kerjasama dalam Menyelesaikan Masalah atau Proyek Bersama</label>
                                <div>
                                    <select class="form-control" name="tingkat_kerjasama" id="tingkat_kerjasama">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Tingkat Keterbukaan dan Transparansi dalam Komunikasi -->
                            <div class="form-group mb-4">
                                <label for="tingkat_keterbukaan" class="control-label">Tingkat Keterbukaan dan Transparansi dalam Komunikasi</label>
                                <div>
                                    <select class="form-control" name="tingkat_keterbukaan" id="tingkat_keterbukaan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kemampuan untuk Memberikan Solusi Inovatif -->
                            <div class="form-group mb-4">
                                <label for="kemampuan_solusi" class="control-label">Kemampuan untuk Memberikan Solusi Inovatif</label>
                                <div>
                                    <select class="form-control" name="kemampuan_solusi" id="kemampuan_solusi">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kontribusi terhadap Pengembangan Produk atau Layanan -->
                            <div class="form-group mb-4">
                                <label for="kontribusi_layanan" class="control-label">Kontribusi terhadap Pengembangan Produk atau Layanan</label>
                                <div>
                                    <select class="form-control" name="kontribusi_layanan" id="kontribusi_layanan">
                                        <option value="">Pilih</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Kurang">Kurang</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Form Foto -->
                            <div class="form-group mb-4">
                                <label for="dokumentasi" name="dokumentasi[]" class="control-label">Dokumentasi</label>
                                <div>
                                    <input type="file" class="form-control" id="dokumentasi" name="dokumentasi[]" multiple>
                                </div>
                            </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form id="evaluasi_kinerja_sistem-form" action="{{ route('evaluasi_kinerja_sistem.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button" name="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
