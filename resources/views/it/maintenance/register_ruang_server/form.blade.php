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
                                <label for="tanggal_register_ruang_server" class="col-md-4 control-label">Tanggal Maintenance</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_register_ruang_server" id="tanggal_register_ruang_server" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Nama Petugas -->
                            <div class="form-group row">
                                <label for="nama_petugas" class="col-md-4 control-label">Nama Petugas</label>
                                <div class="col-md-8">
                                    <input type="text" name="nama_petugas" id="nama_petugas" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Keperluan -->
                            <div class="form-group row">
                                <label for="keperluan" class="col-md-4 control-label">Keperluan</label>
                                <div class="col-md-8">
                                    <input type="text" name="keperluan" id="keperluan" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Kategori Urgensi -->
                            <div class="form-group row">
                                <label for="kategori_urgensi" class="col-md-4 control-label">Kategori Urgensi</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="kategori_urgensi" id="kategori_urgensi" required>
                                        <option value="Rendah">Rendah</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Tinggi">Tinggi</option>
                                        <option value="Pengecekan Rutin">Pengecekan Rutin</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Pihak -->
                            <div class="form-group row">
                                <label for="pihak" class="col-md-4 control-label">Pihak</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="pihak" id="pihak" required>
                                        <option value="INTERNAL">INTERNAL</option>
                                        <option value="EKSTERNAL">EKSTERNAL</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- Kolom 2 -->
                        <div class="col-md-6 px-4">

                            <!-- Form Bagian/Instansi -->
                            <div class="form-group row">
                                <label for="bagian_instansi" class="col-md-4 control-label">Bagian/Instansi</label>
                                <div class="col-md-8">
                                    <input type="text" name="bagian_instansi" id="bagian_instansi" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Keterangan Tambahan -->
                            <div class="form-group row">
                                <label for="keterangan_tambahan" class="col-md-4 control-label">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="5"></textarea>
                                </div>
                            </div>

                            <!-- Form Dokumentasi -->
                            <div class="form-group row">
                                <label for="dokumentasi" class="col-md-4 control-label" name="dokumentasi[]">Dokumentasi</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" id="dokumentasi" name="dokumentasi[]" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form action="{{ route('register_ruang_server.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
