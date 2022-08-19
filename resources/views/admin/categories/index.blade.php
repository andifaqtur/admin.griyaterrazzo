@extends('layouts.layout')

@section('title')
    Kategori
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Kategori</a>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-hover" id="kategori_table">
                        <thead>
                            <tr>
                                <th class="text-center" width="30">No</th>
                                <th class="text-center">Nama Kategori</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center" width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{ ++$no }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ $category->nama }}
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/images/kategori/'.$category->gambar) }}" style="width: 100px; height: 100px;" alt="">
                                    </td>
                                    <td class="align-middle text-center">
                                        <a onclick="editForm({{ $category->id }})" class="btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        <a onclick="deleteButton({{ $category->id }})" class="btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title-delete"></h3>
                    <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" id="smallBody">
                    <div>
                        <label id="text"></label>
                    </div>
                </div>
                <div class="modal-footer" id="btn-group">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="button">Yes!</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.categories.form')
    @include('admin.categories.formEdit')
@endsection

@section('script')
    <script>
        var table, save_method;
        $(function(){
            table = $('#kategori_table').DataTable();

            $('#modal-form form').validator().on('submit', function(e){
                if(!e.isDefaultPrevented()){
                    $.ajax({
                        url : "{{ route('categories.store') }}",
                        type : "POST",
                        data : new FormData(this),
                        success : function(data){
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        },
                        error : function(){
                            alert("Tidak dapat menyimpan data!");
                        }
                    });
                    return false;
                }
            });

            $('#modal-edit-form form').validator().on('submit',function(e){
                let id = $('#id_edit').val();
                if(!e.isDefaultPrevented()){
                    $.ajax({
                        url : "categories/"+id,
                        type : "PATCH",
                        data : $('#modal-edit-form form').serialize(),
                        success : function(data){
                            $('#modal-edit-form').modal('hide');
                            location.reload();
                        },
                        error : function(){
                            alert("Tidak dapat menyimpan data!");
                        }
                    });
                    return false;
                }
            });
        })

        function addForm(){
            save_method = "add";
            $('input[name = _method]').val("POST");
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').html('Buat Kategori Baru');
        }

        function editForm(id){
            $.ajax({
                url: "categories/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modal-edit-form').modal('show');
                    $('.modal-title').html('Edit Kategori');
                    $('#id_edit').val(data.id);
                    $('#kategori_edit').val(data.nama);
                },
                error: function(){
                    alert('Gagal Ambil Data!');
                }
            })
        }

        function deleteButton(id){
            $('#smallModal').modal('show');
            $('.modal-title-delete').html('Delete Kategori');
            $('#text').html('Anda yakin ingin menghapus kategori?');
            $('#smallModal').validator().on('click','#button', function(e){
            if(!e.isDefaultPrevented()){
                $.ajax({
                    url : "categories/"+id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                    success : function(data){
                        $('#smallModal').modal('hide');
                        location.reload();

                    },
                    error : function(){
                        alert("Tidak dapat menghapus data!");
                    }
                });
                return false;
            }
            });
        }
    </script>
@endsection