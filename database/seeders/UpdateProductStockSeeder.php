<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class UpdateProductStockSeeder extends Seeder
{
    public function run()
    {
        // Update semua produk yang sudah ada dengan stok default
        Product::whereNull('stock')->orWhere('stock', 0)->update([
            'stock' => 100 // Stok default
        ]);

        // Update produk berdasarkan tipe
        Product::where('type', 'kasur')->update(['stock' => 50]);
        Product::where('type', 'sofa')->update(['stock' => 30]);
        Product::where('type', 'perlengkapan_bayi')->update(['stock' => 75]);
        Product::where('type', 'add_on')->update(['stock' => 200]);
    }
} 