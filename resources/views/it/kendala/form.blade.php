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
                                <label for="tanggal_kendala" class="col-md-4 control-label">Tanggal Kendala</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_kendala" id="tanggal_kendala" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Urgensi -->
                            <div class="form-group row">
                                <label for="urgensi" class="col-md-4 control-label">Urgensi</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="urgensi" id="urgensi" required>
                                        <option value="">Pilih Urgensi</option>
                                        <option value="Tinggi">Tinggi</option>
                                        <option value="Menengah">Menengah</option>
                                        <option value="Rendah">Rendah</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Klasifikasi -->
                            <div class="form-group row">
                                <label for="klasifikasi" class="col-md-4 control-label">Klasifikasi</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="klasifikasi" id="klasifikasi" required>
                                        <option value="">Pilih Klasifikasi</option>
                                        <option value="CBS">CBS</option>
                                        <option value="Jaringan">Jaringan</option>
                                        <option value="Hardware">Hardware</option>
                                        <option value="Software">Software</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Keterangan Kendala -->
                            <div class="form-group row">
                                <label for="keterangan_kendala" class="col-md-4 control-label">Keterangan Kendala</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_kendala" name="keterangan_kendala" rows="3" required></textarea>
                                </div>
                            </div>

                            <!-- Form Pelapor -->
                            <div class="form-group row">
                                <label for="pelapor" class="col-md-4 control-label">Pelapor</label>
                                <div class="col-md-8">
                                    <input type="text" name="pelapor" id="pelapor" class="form-control" required>
                                </div>
                            </div>

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
                        </div>

                        <!-- Kolom 2 -->
                        <div class="col-md-6 px-4">
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

                            <!-- Form Diselesaikan Oleh -->
                            <div class="form-group row">
                                <label for="diselesaikan_oleh" class="col-md-4 control-label">Diselesaikan Oleh</label>
                                <div class="col-md-8">
                                    <input type="text" name="diselesaikan_oleh" id="diselesaikan_oleh" class="form-control">
                                </div>
                            </div>

                            <!-- Form Status -->
                            <div class="form-group row">
                                <label for="status" class="col-md-4 control-label">Status</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="Belum Selesai">Belum Selesai</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Tanggal Selesai -->
                            <div class="form-group row">
                                <label for="tanggal_selesai" class="col-md-4 control-label">Tanggal Selesai</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
                                </div>
                            </div>

                            <!-- Form Keterangan Tambahan -->
                            <div class="form-group row">
                                <label for="keterangan_tambahan" class="col-md-4 control-label">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- Form Foto -->
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
                    <form id="kendala-form" action="{{ route('kendala.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button" name="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
