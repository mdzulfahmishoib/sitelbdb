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
                            <!-- Form Kantor -->
                            <div class="form-group row">
                                <label for="id_kantor" class="col-md-4 control-label">Kantor</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="id_kantor" id="id_kantor" required>
                                        <option value="">Pilih Kantor</option>
                                        @foreach ($kantor as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Form Unit -->
                            <div class="form-group row">
                                <label for="id_unit_bagian" class="col-md-4 control-label">Unit/Bagian</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="id_unit_bagian" id="id_unit_bagian" required>
                                        <option value="">Pilih Unit</option> 
                                        @foreach ($unit_bagian as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Form Tanggal Pengajuan Rekomendasi -->
                            <div class="form-group row">
                                <label for="tanggal_pengajuan_rekomendasi" class="col-md-4 control-label">Tanggal Pengajuan Rekomendasi</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_pengajuan_rekomendasi" id="tanggal_pengajuan_rekomendasi" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Nama Pemohon Rekomendasi -->
                            <div class="form-group row">
                                <label for="nama_pemohon_rekomendasi" class="col-md-4 control-label">Nama Pemohon Rekomendasi</label>
                                <div class="col-md-8">
                                    <input type="text" name="nama_pemohon_rekomendasi" id="nama_pemohon_rekomendasi" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Tentang Pengadaan -->
                            <div class="form-group row">
                                <label for="tentang_pengadaan" class="col-md-4 control-label">Tentang Pengadaan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="tentang_pengadaan" name="tentang_pengadaan" rows="3" required></textarea>
                                </div>
                            </div>

                            
                        </div>

                        <!-- Kolom 2 -->
                        <div class="col-md-6 px-4">

                            <!-- Form Rekomendasi Pembelian -->
                            <div class="form-group row">
                                <label for="rekomendasi_pembelian" class="col-md-4 control-label">Rekomendasi Pembelian</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="rekomendasi_pembelian" name="rekomendasi_pembelian" rows="2" required></textarea>
                                </div>
                            </div>

                            <!-- Form Dokumentasi -->
                            <div class="form-group row">
                                <label for="dokumentasi" name="dokumentasi[]" class="col-md-4 control-label">Dokumentasi</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="dokumentasi" name="dokumentasi[]" multiple>
                                </div>
                            </div>

                            <!-- Form Status -->
                            <div class="form-group row">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="Belum Disetujui">Belum Disetujui</option>
                                        <option value="Tidak Disetujui">Tidak Disetujui</option>
                                        <option value="Disetujui">Disetujui</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Tanggal Persetujuan -->
                            <div class="form-group row">
                                <label for="tanggal_persetujuan_rekomendasi" class="col-md-4 control-label">Tanggal Persetujuan</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_persetujuan_rekomendasi" id="tanggal_persetujuan_rekomendasi" class="form-control">
                                </div>
                            </div>

                            <!-- Form Keterangan Tambahan -->
                            <div class="form-group row">
                                <label for="keterangan_tambahan" class="col-md-4 control-label">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form id="rekomendasi-form" action="{{ route('rekomendasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button" name="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
