<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\PhotoProduct;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('kategori', 'photo_product')->get();
        $categories = Category::get();
        $no = 0;
        return view('admin.products.index', compact('products', 'no', 'categories'));
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
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'kategori' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'keterangan' => 'required',
        ]);

        $product = new Product;
        $product->nama = $request->nama_produk;
        $product->kategori_id = $request->kategori;
        $product->harga = $request->harga;
        $product->jumlah_stok = $request->stok;
        $product->berat = $request->berat;
        $product->keterangan = $request->keterangan;
        $product->save();

        $photo = new PhotoProduct;
        $nama_gambar = $request->file('gambar');
        foreach ($nama_gambar as $gambar) {
            $change = $gambar->getClientOriginalName();
            $gambar->move(public_path('assets/product'), $change);
            $photo->product_id = $product->id;
            $photo->photo_path = $change;
            $photo->save();
        }

        return Redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('kategori', 'photo_product')->find($id);

        echo json_encode($product);
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
        $validator = Validator::make($request->all(), [
            'nama_edit' => 'required',
            'kategori_edit' => 'required',
            'stok_edit' => 'required',
            'harga_edit' => 'required',
            'berat_edit' => 'required',
            // 'gambar_edit' => 'required',
            'keterangan_edit' => 'required',
        ]);
        // $nama_gambar = $request->file('gambar_edit')->getClientOriginalName();

        // $request->file('gambar_edit')->storeAs('/public/images/product', $nama_gambar);

        $product = Product::find($id);
        $product->nama = $request->nama_edit;
        $product->kategori_id = $request->kategori_edit;
        $product->jumlah_stok = $request->stok_edit;
        $product->harga = $request->harga_edit;
        $product->berat = $request->berat_edit;
        // $product->gambar = $nama_gambar;
        $product->keterangan = $request->keterangan_edit;
        $product->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
