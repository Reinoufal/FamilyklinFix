<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Kasur Products
        $kasurCategory = Category::where('name', 'Kasur')->first();
        $kasurProducts = [
            [
                'name' => 'Kasur Super King',
                'description' => 'Layanan cuci kasur ukuran Super King',
                'price' => 350000,
                'type' => 'kasur',
                'size' => 'super_king'
            ],
            [
                'name' => 'Kasur King',
                'description' => 'Layanan cuci kasur ukuran King',
                'price' => 300000,
                'type' => 'kasur',
                'size' => 'king'
            ],
            [
                'name' => 'Kasur Queen',
                'description' => 'Layanan cuci kasur ukuran Queen',
                'price' => 260000,
                'type' => 'kasur',
                'size' => 'queen'
            ],
            [
                'name' => 'Kasur Single',
                'description' => 'Layanan cuci kasur ukuran Single',
                'price' => 200000,
                'type' => 'kasur',
                'size' => 'single'
            ],
            [
                'name' => 'Kasur Kecil',
                'description' => 'Layanan cuci kasur ukuran Kecil',
                'price' => 150000,
                'type' => 'kasur',
                'size' => 'kecil'
            ]
        ];

        // Sofa Products
        $sofaCategory = Category::where('name', 'Sofa')->first();
        $sofaProducts = [
            [
                'name' => 'Sofa Standard',
                'description' => 'Layanan cuci sofa ukuran Standard',
                'price' => 65000,
                'type' => 'sofa',
                'size' => 'standard'
            ],
            [
                'name' => 'Sofa Jumbo',
                'description' => 'Layanan cuci sofa ukuran Jumbo',
                'price' => 75000,
                'type' => 'sofa',
                'size' => 'jumbo'
            ],
            [
                'name' => 'Sofa Bed',
                'description' => 'Layanan cuci sofa bed',
                'price' => 200000,
                'type' => 'sofa',
                'size' => 'bed'
            ],
            [
                'name' => 'Sofa L',
                'description' => 'Layanan cuci sofa bentuk L',
                'price' => 300000,
                'type' => 'sofa',
                'size' => 'L_shape'
            ],
            [
                'name' => 'Sofa Recliner',
                'description' => 'Layanan cuci sofa recliner',
                'price' => 95000,
                'type' => 'sofa',
                'size' => 'recliner'
            ]
        ];

        // Perlengkapan Bayi Products
        $bayiCategory = Category::where('name', 'Perlengkapan Bayi')->first();
        $bayiProducts = [
            [
                'name' => 'Matras Bayi',
                'description' => 'Layanan cuci matras bayi',
                'price' => 100000,
                'type' => 'perlengkapan_bayi'
            ],
            [
                'name' => 'Box Bayi',
                'description' => 'Layanan cuci box bayi',
                'price' => 100000,
                'type' => 'perlengkapan_bayi'
            ],
            [
                'name' => 'Stroller/Car Seat',
                'description' => 'Layanan cuci stroller atau car seat bayi',
                'price' => 80000,
                'type' => 'perlengkapan_bayi'
            ],
            [
                'name' => 'Bouncer',
                'description' => 'Layanan cuci bouncer bayi',
                'price' => 80000,
                'type' => 'perlengkapan_bayi'
            ]
        ];

        // Add On Products
        $addOnCategory = Category::where('name', 'Add On')->first();
        $addOnProducts = [
            [
                'name' => 'Kursi',
                'description' => 'Layanan cuci kursi',
                'price' => 35000,
                'type' => 'add_on'
            ],
            [
                'name' => 'Karpet',
                'description' => 'Layanan cuci karpet per m2',
                'price' => 25000,
                'type' => 'add_on',
                'unit' => 'm2'
            ],
            [
                'name' => 'Gorden',
                'description' => 'Layanan cuci gorden per m2',
                'price' => 20000,
                'type' => 'add_on',
                'unit' => 'm2'
            ],
            [
                'name' => 'Car Interior (5 Seat)',
                'description' => 'Layanan cuci interior mobil 5 kursi',
                'price' => 250000,
                'type' => 'add_on',
                'seat_count' => 5
            ],
            [
                'name' => 'Car Interior (8 Seat)',
                'description' => 'Layanan cuci interior mobil 8 kursi',
                'price' => 350000,
                'type' => 'add_on',
                'seat_count' => 8
            ],
            [
                'name' => 'Bantal/Guling',
                'description' => 'Layanan cuci bantal atau guling',
                'price' => 15000,
                'type' => 'add_on'
            ]
        ];

        // Create all products and attach categories
        foreach ($kasurProducts as $product) {
            $newProduct = Product::create($product);
            $newProduct->categories()->attach($kasurCategory->id);
        }

        foreach ($sofaProducts as $product) {
            $newProduct = Product::create($product);
            $newProduct->categories()->attach($sofaCategory->id);
        }

        foreach ($bayiProducts as $product) {
            $newProduct = Product::create($product);
            $newProduct->categories()->attach($bayiCategory->id);
        }

        foreach ($addOnProducts as $product) {
            $newProduct = Product::create($product);
            $newProduct->categories()->attach($addOnCategory->id);
        }
    }
}