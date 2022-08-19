<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::with('user', 'pesanan_details')->get();
        $no = 0;

        return view('admin.penjualan.index', compact('penjualan', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penjualan = Penjualan::find($id);

        echo json_encode($penjualan);
    }

    public function detail_pesanan($id)
    {
        $detail_penjualan = PenjualanDetail::with('product')->where('pesanan_id', '=', $id)->get();
        $no = 0;
        $data = array();
        foreach($detail_penjualan as $list){
            $row = [];
            $row[] = ++$no;
            $row[] = "<img src='storage/images/product/".$list->product->gambar."' style='height: 100px; width: 100px' />";
            $row[] = $list->product->nama;
            $row[] = $list->jumlah_pesanan;
            $row[] = $list->total_berat;
            $row[] = "Rp.".number_format($list->total_harga);
            $data[] = $row;
        }

        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pesanan = Penjualan::find($id);
        $pesanan->status = $request->status;
        $pesanan->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
