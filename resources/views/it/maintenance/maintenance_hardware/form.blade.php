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
                                <label for="tanggal_maintenance_hardware" class="col-md-4 control-label">Tanggal Maintenance</label>
                                <div class="col-md-8">
                                    <input type="date" name="tanggal_maintenance_hardware" id="tanggal_maintenance_hardware" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Kategori Maintenance -->
                            <div class="form-group row">
                                <label for="id_kategori_maintenance_hardware" class="col-md-4 control-label">Kategori Maintenance</label>
                                <div class="col-md-8">
                                    <select name="id_kategori_maintenance_hardware" id="id_kategori_maintenance_hardware" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Form Kondisi Hardware -->
                            <div class="form-group row">
                                <label for="kondisi_maintenance_hardware" class="col-md-4 control-label">Kondisi Hardware</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="kondisi_maintenance_hardware" id="kondisi_maintenance_hardware" required>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Keterangan Maintenance -->
                            <div class="form-group row">
                                <label for="keterangan_maintenance_hardware" class="col-md-4 control-label">Keterangan Maintenance</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_maintenance_hardware" name="keterangan_maintenance_hardware" rows="3" required></textarea>
                                </div>
                            </div>

                        </div>

                        <!-- Kolom 2 -->
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

                            <!-- Form Dicek Oleh -->
                            <div class="form-group row">
                                <label for="dicek_oleh" class="col-md-4 control-label">Dicek Oleh</label>
                                <div class="col-md-8">
                                    <input type="text" name="dicek_oleh" id="dicek_oleh" class="form-control">
                                </div>
                            </div>

                            <!-- Form Keterangan Tambahan -->
                            <div class="form-group row">
                                <label for="keterangan_tambahan_maintenance_hardware" class="col-md-4 control-label">Keterangan Tambahan</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="keterangan_tambahan_maintenance_hardware" name="keterangan_tambahan_maintenance_hardware" rows="3"></textarea>
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
                    <form action="{{ route('maintenance_hardware.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
