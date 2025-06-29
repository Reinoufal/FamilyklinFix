<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Hydrovacuum',
            'Cuci Kasur',
            'Kasur',
            'Sofa',
            'Perlengkapan Bayi',
            'Add On'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}