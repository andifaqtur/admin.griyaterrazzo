<div class="modal fade" id="modal-edit-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <form class="form-horizontal" method="PATCH" enctype="multipart/form-data" data-toggle="validator" id="product_edit">
        @method('PATCH')
        @csrf
            <div class="modal-header">
                <h3 class="modal-title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_edit" name="id">
                <div class="form-group">
                    <div class="mt-2">
                        <label for="nama_edit" class="col-md-6 control-label">Nama Produk</label>
                        <div class="col-md-12">
                        <input id="nama_edit" type="text" class="form-control nama_edit" name="nama_edit" autofocus required>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="kategori_edit" class="col-md-6 control-label">Kategori</label>
                        <div class="col-md-12">
                        <select name="kategori_edit" id="kategori_edit" class="form-control">
                            <option value="0">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama }}</option>
                            @endforeach
                        </select>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="stok_edit" class="col-md-6 control-label">Stok</label>
                        <div class="col-md-12">
                        <input id="stok_edit" type="number" class="form-control stok_edit" name="stok_edit" autofocus required>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="harga_edit" class="col-md-6 control-label">Harga</label>
                        <div class="col-md-12">
                        <input id="harga_edit" type="number" class="form-control harga_edit" name="harga_edit" autofocus required>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="berat_edit" class="col-md-6 control-label">Berat (Kg)</label>
                        <div class="col-md-12">
                        <input id="berat_edit" type="text" class="form-control berat_edit" name="berat_edit" autofocus required>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    {{-- <div class="mt-2">
                        <label for="gambar_edit" class="col-md-6 control-label">Gambar</label>
                        <div class="col-md-12">
                        <input type="file" name="gambar_edit" id="gambar_edit" class="form-control" accept="image/png, image/jpeg" autofocus>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div> --}}
                    <div class="mt-2">
                        <label for="keterangan_edit" class="col-md-6 control-label">Keterangan</label>
                        <div class="col-md-12">
                        <input id="keterangan_edit" type="text" class="form-control keterangan_edit" name="keterangan_edit" autofocus required>
                        <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-save" id="update">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>