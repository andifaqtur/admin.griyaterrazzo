@extends('layouts.layout')

@section('title')
    Produk
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Produk</a>
                </div>
                <div class="card-body ">

                    <table class="table table-bordered table-hover" id="produk_table">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th class="align-middle">Gambar</th>
                                <th class="align-middle text-center">Nama</th>
                                <th class="align-middle">Kategori</th>
                                <th class="align-middle">Stock</th>
                                <th class="align-middle">Harga</th>
                                <th class="align-middle">Berat</th>
                                <th class="align-middle">Keterangan</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="align-middle text-center">{{ ++$no }}</td>
                                    <td class="align-middle text-center">
                                        <img src="{{ asset('assets/product/'.$product->photo_product[0]->photo_path) }}" alt="" style="width: 100px; height: 100px">
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ $product->nama }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ $product->kategori['nama']??"Null" }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ $product->jumlah_stok }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ "Rp.".number_format($product->harga) }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ $product->berat }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ $product->keterangan }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <a onclick="detailForm({{ $product->id }})" class="btn-sm btn-secondary"><i class="fas fa-eye"></i></a>
                                        <a onclick="editForm({{ $product->id }})" class="btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                        <a onclick="deleteButton({{ $product->id }})" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
                    <button type="submit" class="btn btn-danger" id="delete">Yes!</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.products.form')
    @include('admin.products.detail')
    @include('admin.products.formEdit')
@endsection

@section('script')
    <script>
        var table, save_method;
        $(function(){
            table = $('#produk_table').DataTable();

            $('#modal-form form').validator().on('submit', function(e){
                if(!e.isDefaultPrevented()){
                    // if(save_method == "add") url = "{{ route('products.store') }}";
                    // else url = "products/"+id;

                    $.ajax({
                        url : "{{ route('products.store') }}",
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
                        url : "products/"+id,
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
        });


        function addForm(){
            save_method = "add";
            $('input[name = _method]').val("POST");
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').html('Buat Produk Baru');
        }

        function editForm(id){
            $.ajax({
                url: "products/"+id,
                type : "GET",
                dataType : "JSON",
                success:function (data){
                    $('#modal-edit-form').modal('show');
                    $('.modal-title').text('Edit Produk');
                    $('#id_edit').val(data.id);
                    $('#nama_edit').val(data.nama);
                    $('#kategori_edit').val(data.kategori_id).change();
                    $('#stok_edit').val(data.jumlah_stok);
                    $('#harga_edit').val(data.harga);
                    $('#berat_edit').val(data.berat);
                    $('#keterangan_edit').val(data.keterangan);
                }
            })
        }

        function detailForm(id){
            $.ajax({
                url: "products/"+id,
                type : "GET",
                dataType : "JSON",
                success:function (data){
                    let location = window.location.origin;
                    $('#modal-form-detail').modal('show');
                    $('.modal-title-detail').text('Detail Produk');
                    $('#detail_nama_produk').val(data.nama);
                    $('#detail_kategori').val(data.kategori_id).change();
                    $('#detail_stok').val(data.jumlah_stok);
                    $('#detail_harga').val(data.harga);
                    $('#detail_berat').val(data.berat);
                    $('#detail_keterangan').val(data.keterangan);
                    // $('#detail_gambar').attr('src', '/assets/product/'+data.photo_product[0].photo_path)
                }
            })
        }

        function deleteButton(id){
            $('#smallModal').modal('show');
            $('.modal-title-delete').text('Delete Produk');
            $('#text').text('Anda yakin ingin menghapus produk?');
            $('#smallModal').validator().on('click','#delete', function(e){
            if(!e.isDefaultPrevented()){
                $.ajax({
                    url : "products/"+id,
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