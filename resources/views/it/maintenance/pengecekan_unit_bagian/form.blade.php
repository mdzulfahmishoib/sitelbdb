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
                            <!-- Form Kantor -->
                            <div class="form-group">
                                <label for="id_kantor" class="control-label">Kantor</label>
                                <div>
                                    <select class="form-control" name="id_kantor" id="id_kantor" required>
                                        <option value="">Pilih Kantor</option>
                                        @foreach ($kantor as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Form Unit -->
                            <div class="form-group">
                                <label for="id_unit_bagian" class="control-label">Unit/Bagian</label>
                                <div>
                                    <select class="form-control" name="id_unit_bagian" id="id_unit_bagian" required>
                                        <option value="">Pilih Unit</option> 
                                        @foreach ($unit_bagian as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Form Tanggal Pengecekan -->
                            <div class="form-group">
                                <label for="tanggal_pengecekan_unit_bagian" class="control-label">Tanggal Pengecekan</label>
                                <div>
                                    <input type="date" name="tanggal_pengecekan_unit_bagian" id="tanggal_pengecekan_unit_bagian" class="form-control" required>
                                </div>
                            </div>

                            <!-- Form Komputer / Laptop (mouse + keyboard) -->
                            <div class="form-group mb-4">
                                <label for="komputer_laptop" class="control-label">Komputer / Laptop (mouse + keyboard)</label>
                                <div>
                                    <select class="form-control" name="komputer_laptop" id="komputer_laptop">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Printer dan Fotocopy -->
                            <div class="form-group mb-4">
                                <label for="printer" class="control-label">Printer dan Fotocopy</label>
                                <div>
                                    <select class="form-control" name="printer" id="printer">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Scan -->
                            <div class="form-group mb-4">
                                <label for="scan" class="control-label">Scan</label>
                                <div>
                                    <select class="form-control" name="scan" id="scan">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Jaringan / LAN / Wifi -->
                            <div class="form-group mb-4">
                                <label for="jaringan" class="control-label">Jaringan / LAN / Wifi</label>
                                <div>
                                    <select class="form-control" name="jaringan" id="jaringan">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Mesin Hitung / Tel -->
                            <div class="form-group mb-4">
                                <label for="mesin_hitung" class="control-label">Mesin Hitung / Tel</label>
                                <div>
                                    <select class="form-control" name="mesin_hitung" id="mesin_hitung">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Windows -->
                            <div class="form-group mb-4">
                                <label for="windows" class="control-label">Windows</label>
                                <div>
                                    <select class="form-control" name="windows" id="windows">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Microsoft Office -->
                            <div class="form-group mb-4">
                                <label for="microsoft_office" class="control-label">Microsoft Office</label>
                                <div>
                                    <select class="form-control" name="microsoft_office" id="microsoft_office">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Antivirus -->
                            <div class="form-group mb-4">
                                <label for="antivirus" class="control-label">Antivirus</label>
                                <div>
                                    <select class="form-control" name="antivirus" id="antivirus">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Browser -->
                            <div class="form-group mb-4">
                                <label for="browser" class="control-label">Browser</label>
                                <div>
                                    <select class="form-control" name="browser" id="browser">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Core Banking System -->
                            <div class="form-group mb-4">
                                <label for="cbs" class="control-label">Core Banking System</label>
                                <div>
                                    <select class="form-control" name="cbs" id="cbs">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Cek E-KTP (Jaringan Bersama Perbarindo) -->
                            <div class="form-group mb-4">
                                <label for="cek_ktp" class="control-label">Cek E-KTP (Jaringan Bersama Perbarindo)</label>
                                <p class="text-danger text-xs">*Hanya di isi Customer Service</p>
                                <div>
                                    <select class="form-control" name="cek_ktp" id="cek_ktp">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Cek DVR CCTV dan Mikrotik  -->
                            <div class="form-group mb-4">
                                <label for="dvr_mikrotik" class="control-label">Cek DVR CCTV dan Mikrotik</label>
                                <p class="text-danger text-xs">*Selain Kantor Pusat</p>
                                <div>
                                    <select class="form-control" name="dvr_mikrotik" id="dvr_mikrotik">
                                        <option value="">Pilih</option>
                                        <option value="Optimal">Optimal</option>
                                        <option value="Cukup Optimal">Cukup Optimal</option>
                                        <option value="Tidak Optimal">Tidak Optimal</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Form Keterangan Tambahan -->
                            <div class="form-group">
                                <label for="keterangan_tambahan" class="control-label">Keterangan Tambahan</label>
                                <div>
                                    <textarea class="form-control" id="keterangan_tambahan" name="keterangan_tambahan" rows="3"></textarea>
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
                    <form id="pengecekan_unit_bagian-form" action="{{ route('pengecekan_unit_bagian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Form fields -->
                        <button type="submit" class="btn btn-primary" id="submit-button" name="submit-button">Simpan</button>
                    </form>
                    
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
