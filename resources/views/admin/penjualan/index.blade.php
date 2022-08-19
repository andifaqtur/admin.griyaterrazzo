@extends('layouts.layout')

@section('title')
    Penjualan
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Penjualan</li>
@endsection

@section('content')
    <style>
        #pesanan_detail tbody tr td{
            vertical-align: middle !important;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header">
                </div> --}}
                <div class="card-body">

                    <table class="table table-bordered table-hover" id="penjualan_table">
                        <thead>
                            <tr>
                                <th class="text-center" width="30">No</th>
                                <th class="text-center">Kode Pemesanan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Berat(Kg)</th>
                                <th class="text-center">Kode Unik</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Pembeli</th>
                                <th class="text-center" width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan as $list)
                                <tr>
                                    <td class="align-middle text-center">
                                        {{ ++$no }}
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ $list->kode_pemesanan }}
                                    </td>
                                    <td class="text-center">
                                        @if ($list->status == 1)
                                            Belum Dibayar
                                        @elseif ($list->status == 2)
                                            Sudah Dibayar
                                        @elseif ($list->status == 3)
                                            Sedang Dikirim
                                        @elseif ($list->status == 4)
                                            Selesai
                                        @elseif ($list->status == 0)
                                            Keranjang
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $list->total_berat }}
                                    </td>
                                    <td class="text-center">
                                        {{ $list->kode_unik }}
                                    </td>
                                    <td class="text-center">
                                        {{ "Rp. ".number_format($list->total_harga) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $list->user->alamat }}
                                    </td>
                                    <td class="text-center">
                                        {{ $list->user->name }}
                                    </td>
                                    <td class="align-middle text-center">
                                        <a onclick="detailForm({{ $list->id }})" class="btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
                                        <a onclick="editButton({{ $list->id }})" class="btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" data-toggle="validator">
                    @method('PATCH')
                    @csrf
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Status Pesanan</h3>
                        <button type="button" class="close" id="close-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="smallBody">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <div class="mt-2">
                                <label for="status" class="col-md-6 control-label">Status</label>
                                <div class="col-md-12">
                                    <select name="status" class="form-control status" id="status">
                                        <option value="">Pilih Status</option>
                                        <option value="1">Belum Dibayar</option>
                                        <option value="2">Sudah Dibayar</option>
                                        <option value="3">Sedang Dikirim</option>
                                        <option value="4">Selesai</option>
                                    </select>
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

    @include('admin.penjualan.detail')
@endsection

@section('script')
    <script>
        var table, pesanan_detail;
        $(function(){
            table = $('#penjualan_table').DataTable();

            $('#modal-edit form').validator().on('submit',function(e){
                let id = $('#id').val();
                if(!e.isDefaultPrevented()){
                    $.ajax({
                        url : "penjualan/"+id,
                        type : "PATCH",
                        data : $('#modal-edit form').serialize(),
                        success : function(data){
                            $('#modal-edit').modal('hide');
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

        function detailForm(id){
            $.ajax({
                url: "penjualan/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modal-form-detail').modal('show');
                    $('.modal-title').html('Detail Pesanan');

                    if(pesanan_detail){
                        pesanan_detail.destroy();
                    }

                    pesanan_detail = $('#pesanan_detail').DataTable({
                        "responsive": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "penjualan/detail/"+id,
                            "type": "GET",
                        },
                        "info": false,
                        "searching": false,
                    })
                },
                error: function(){
                    alert('Gagal Ambil Data!');
                }
            })
        }

        function editButton(id){
            $.ajax({
                url: "penjualan/"+id,
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modal-edit').modal('show');
                    $('#id').val(data.id);
                    $('#status').val(data.status).change();
                },
                error: function(){
                    alert('gagal');
                }
            })
        }
    </script>
@endsection