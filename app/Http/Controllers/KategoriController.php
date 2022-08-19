<?php

namespace App\Http\Controllers;

use App\Models\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $no = 0;
        return view('admin.categories.index', compact('categories', 'no'));
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
        $nama_gambar = $request->file('gambar')->getClientOriginalName();

        $request->file('gambar')->storeAs('/public/images/kategori', $nama_gambar);

        $kategori = new Category;
        $kategori->nama = $request->kategori;
        $kategori->gambar = $nama_gambar;
        $kategori->save();

        return Redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        echo json_encode($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        echo json_encode($category);
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
        // $nama_gambar = $request->file('gambar_edit')->getClientOriginalName();

        // $request->file('gambar_edit')->storeAs('/public/images/kategori', $nama_gambar);

        $kategori = Category::find($id);
        $kategori->nama = $request->kategori_edit;
        // $kategori->gambar = $nama_gambar;
        $kategori->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Category::find($id);
        $kategori->delete();
    }
}
