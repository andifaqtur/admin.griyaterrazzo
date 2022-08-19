<div class="modal fade" id="modal-edit-form" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" id="edit_kategori">
            @method('PATCH')
            @csrf
                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <input type="hidden" id="id_edit">
                    <div class="form-group">
                        <div class="mt-2">
                            <label for="kategori_edit" class="col-md-6 control-label">Nama Kategori</label>
                            <div class="col-md-12">
                                <input id="kategori_edit" type="text" class="form-control kategori" name="kategori_edit" autofocus required>
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
                    </div>
                </div>
                <div class="modal-footer" id="btn-group">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="update">Yes!</button>
                </div>
            </form>
        </div>
    </div>
</div>