<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Array harga untuk range
        $hargaKasur = [
            'Kasur Super King' => [170000, 350000],
            'Kasur King' => [160000, 300000],
            'Kasur Queen' => [150000, 260000],
            'Kasur Singel' => [120000, 200000],
            'Kasur Kecil' => [85000, 150000],
        ];
        $hargaSofa = [
            'Sofa Standart' => [50000, 65000],
            'Sofa Jumbo' => [55000, 75000],
            'Sofa Bed' => [125000, 200000],
            'Sofa L' => [175000, 300000],
            'Sofa Reclainer' => [75000, 95000],
        ];
        $hargaPerlengkapanBayi = [
            'Matras Bayi' => [60000, 100000],
            'Box Bayi' => [60000, 100000],
            'Stroler, Car seat' => [50000, 80000],
            'Bouncer' => [50000, 80000],
        ];
        $hargaAddOn = [
            'Kursi' => [30000, 30000],
            'Karpet (m2)' => [15000, 15000],
            'Tirai (m2)' => [10000, 10000],
            'Car interior (5 seat)' => [150000, 150000],
            'Car interior (8 seat)' => [180000, 180000],
            'Bantal / guling' => [5000, 5000],
        ];

        $products = [
            // Kasur
            ['name' => 'Kasur Super King', 'type' => 'kasur', 'description' => ''],
            ['name' => 'Kasur King', 'type' => 'kasur', 'description' => ''],
            ['name' => 'Kasur Queen', 'type' => 'kasur', 'description' => ''],
            ['name' => 'Kasur Singel', 'type' => 'kasur', 'description' => ''],
            ['name' => 'Kasur Kecil', 'type' => 'kasur', 'description' => ''],
            // Sofa
            ['name' => 'Sofa Standart', 'type' => 'sofa', 'description' => ''],
            ['name' => 'Sofa Jumbo', 'type' => 'sofa', 'description' => ''],
            ['name' => 'Sofa Bed', 'type' => 'sofa', 'description' => ''],
            ['name' => 'Sofa L', 'type' => 'sofa', 'description' => ''],
            ['name' => 'Sofa Reclainer', 'type' => 'sofa', 'description' => ''],
            // Perlengkapan Bayi
            ['name' => 'Matras Bayi', 'type' => 'perlengkapan_bayi', 'description' => ''],
            ['name' => 'Box Bayi', 'type' => 'perlengkapan_bayi', 'description' => ''],
            ['name' => 'Stroler, Car seat', 'type' => 'perlengkapan_bayi', 'description' => ''],
            ['name' => 'Bouncer', 'type' => 'perlengkapan_bayi', 'description' => ''],
            // Add On
            ['name' => 'Kursi', 'type' => 'add_on', 'description' => ''],
            ['name' => 'Karpet (m2)', 'type' => 'add_on', 'description' => ''],
            ['name' => 'Tirai (m2)', 'type' => 'add_on', 'description' => ''],
            ['name' => 'Car interior (5 seat)', 'type' => 'add_on', 'description' => ''],
            ['name' => 'Car interior (8 seat)', 'type' => 'add_on', 'description' => ''],
            ['name' => 'Bantal / guling', 'type' => 'add_on', 'description' => ''],
        ];

        foreach ($products as &$product) {
            $name = $product['name'];
            if ($product['type'] === 'kasur' && isset($hargaKasur[$name])) {
                $product['price'] = $hargaKasur[$name][0];
                $product['stock'] = 50;
            } elseif ($product['type'] === 'sofa' && isset($hargaSofa[$name])) {
                $product['price'] = $hargaSofa[$name][0];
                $product['stock'] = 30;
            } elseif ($product['type'] === 'perlengkapan_bayi' && isset($hargaPerlengkapanBayi[$name])) {
                $product['price'] = $hargaPerlengkapanBayi[$name][0];
                $product['stock'] = 75;
            } elseif ($product['type'] === 'add_on' && isset($hargaAddOn[$name])) {
                $product['price'] = $hargaAddOn[$name][0];
                $product['stock'] = 200;
            } else {
                $product['price'] = 0;
                $product['stock'] = 100;
            }
        }
        unset($product);

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}