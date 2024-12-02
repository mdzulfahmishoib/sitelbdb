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
                    <!-- Form Nama Sistem -->
                    <div class="form-group row">
                        <label for="judul" class="col-md-4 control-label">Nama Sistem</label>
                        <div class="col-md-8">
                            <input type="text" name="judul" id="judul" class="form-control" required>
                        </div>
                    </div>

                    <!-- Form Deskripsi -->
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                    </div>

                    <!-- Form Foto -->
                    <div class="form-group row">
                        <label for="dokumentasi" name="dokumentasi[]" class="col-md-4 control-label">Foto</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" id="dokumentasi" name="dokumentasi[]">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <form id="kategori_produk_kredit-form" action="{{ route('kategori_produk_kredit.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button" name="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
