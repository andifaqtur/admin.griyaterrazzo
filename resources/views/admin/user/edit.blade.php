<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" data-toggle="validator">
                    @method('POST')
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title"></h3>
                        <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="smallBody">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <div class="mt-2">
                                <label for="name_edit" class="col-md-6 control-label">Nama</label>
                                <div class="col-md-12">
                                    <input id="name_edit" type="text" class="form-control name_edit" name="name_edit" autofocus required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="role_edit" class="col-md-6 control-label">Role</label>
                                <div class="col-md-12">
                                    <select name="role_edit" class="form-control role_edit" id="role_edit">
                                        <option value="">Pilih Role</option>
                                        <option value="1">Owner</option>
                                        <option value="2">Karyawan</option>
                                    </select>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="email_edit" class="col-md-6 control-label">E-mail</label>
                                <div class="col-md-12">
                                    <input id="email_edit" type="text" class="form-control email_edit" name="email_edit" autofocus required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="btn-group">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" id="button">Yes!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>