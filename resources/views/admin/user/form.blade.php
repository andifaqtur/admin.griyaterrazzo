<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form class="form-horizontal" action="{{ route('users.store') }}" method="POST" data-toggle="validator">
                    @method('POST')
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title"></h3>
                        <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="smallBody">
                        <div class="form-group">
                            <div class="mt-2">
                                <label for="name" class="col-md-6 control-label">Nama</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control name" name="name" autofocus required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="role" class="col-md-6 control-label">Role</label>
                                <div class="col-md-12">
                                    <select name="role" class="form-control" id="role">
                                        <option value="">Pilih Role</option>
                                        <option value="1">Owner</option>
                                        <option value="2">Karyawan</option>
                                    </select>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="email" class="col-md-6 control-label">E-mail</label>
                                <div class="col-md-12">
                                    <input id="email" type="text" class="form-control email" name="email" autofocus required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="password" class="col-md-6 control-label">Password</label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control password" name="password" autofocus required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <label for="confirm_password" class="col-md-6 control-label">Konfirmasi Password</label>
                                <div class="col-md-12">
                                    <input id="confirm_password" type="password" class="form-control confirm_password" name="confirm_password" autofocus required>
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