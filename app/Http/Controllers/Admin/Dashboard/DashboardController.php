<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pesanan = Penjualan::get()->count();
        return view('admin/dashboard/index', compact('pesanan'));
    }
}
