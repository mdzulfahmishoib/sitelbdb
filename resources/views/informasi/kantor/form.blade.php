<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog" role="document">
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
                    <!-- Form Nama Kantor -->
                    <div class="form-group row">
                        <label for="nama_kantor" class="col-md-4 control-label">Nama Kantor</label>
                        <div class="col-md-8">
                            <input type="text" name="nama_kantor" id="nama_kantor" class="form-control" required>
                        </div>
                    </div>

                    <!-- Form Jenis Kantor -->
                    <div class="form-group row">
                        <label for="jenis_kantor" class="col-md-4 control-label">Jenis Kantor</label>
                        <div class="col-md-8">
                            <select class="form-control" name="jenis_kantor" id="jenis_kantor" required>
                                <option value="PUSAT">PUSAT</option>
                                <option value="CABANG">CABANG</option>
                                <option value="KAS">KAS</option>
                            </select>
                        </div>
                    </div>

                    <!-- Form Nomor Telepon -->
                    <div class="form-group row">
                        <label for="telepon_kantor" class="col-md-4 control-label">Nomor Telepon</label>
                        <div class="col-md-8">
                            <input type="text" name="telepon_kantor" id="telepon_kantor" class="form-control" required>
                        </div>
                    </div>

                    <!-- Form Email -->
                    <div class="form-group row">
                        <label for="email_kantor" class="col-md-4 control-label">Email</label>
                        <div class="col-md-8">
                            <input type="text" name="email_kantor" id="email_kantor" class="form-control" required>
                        </div>
                    </div>

                    <!-- Form Alamat -->
                    <div class="form-group row">
                        <label for="alamat_kantor" class="col-md-4 control-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="alamat_kantor" name="alamat_kantor" rows="3" required></textarea>
                        </div>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form action="{{ route('kantor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
