<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;
    protected $table = 'pesanan_details';
    protected $primaryKey = 'id';

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Penjualan::class, 'pesanan_id');
    }
}
