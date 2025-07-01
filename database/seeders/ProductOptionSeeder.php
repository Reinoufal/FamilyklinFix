<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;

class ProductOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        
        foreach ($products as $product) {
            $this->createOptionsForProduct($product);
        }
    }

    private function createOptionsForProduct($product)
    {
        // Clear existing options
        $product->options()->delete();

        switch ($product->type) {
            case 'kasur':
                $this->createKasurOptions($product);
                break;
            case 'sofa':
                $this->createSofaOptions($product);
                break;
            case 'perlengkapan_bayi':
                $this->createBabyOptions($product);
                break;
            case 'add_on':
                $this->createAddOnOptions($product);
                break;
        }
    }

    private function createKasurOptions($product)
    {
        // Services Option
        $servicesOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Services',
            'type' => 'checkbox',
            'required' => true,
            'sort_order' => 1
        ]);

        $services = [
            ['name' => 'HydroClean Vacuum', 'price_modifier' => 50000],
            ['name' => 'SiriBersih Gentle Wash', 'price_modifier' => 75000],
            ['name' => 'SiriBersih Stain Wash', 'price_modifier' => 100000],
        ];

        foreach ($services as $index => $service) {
            ProductOptionValue::create([
                'product_option_id' => $servicesOption->id,
                'name' => $service['name'],
                'price_modifier' => $service['price_modifier'],
                'sort_order' => $index + 1
            ]);
        }

        // Size Option (for kasur)
        $sizeOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Size',
            'type' => 'select',
            'required' => true,
            'sort_order' => 2
        ]);

        $sizes = [
            ['name' => 'Single (100 x 200)', 'price_modifier' => 0],
            ['name' => 'Single (120 x 200)', 'price_modifier' => 20000],
            ['name' => 'Queen (160 x 200)', 'price_modifier' => 50000],
            ['name' => 'King (180 x 200)', 'price_modifier' => 75000],
            ['name' => 'Super King (200 x 200)', 'price_modifier' => 100000],
        ];

        foreach ($sizes as $index => $size) {
            ProductOptionValue::create([
                'product_option_id' => $sizeOption->id,
                'name' => $size['name'],
                'price_modifier' => $size['price_modifier'],
                'sort_order' => $index + 1
            ]);
        }
    }

    private function createSofaOptions($product)
    {
        // Services Option
        $servicesOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Services',
            'type' => 'checkbox',
            'required' => true,
            'sort_order' => 1
        ]);

        $services = [
            ['name' => 'Deep Clean Vacuum', 'price_modifier' => 40000],
            ['name' => 'Fabric Protection', 'price_modifier' => 60000],
            ['name' => 'Stain Removal', 'price_modifier' => 80000],
            ['name' => 'Deodorizing Treatment', 'price_modifier' => 30000],
        ];

        foreach ($services as $index => $service) {
            ProductOptionValue::create([
                'product_option_id' => $servicesOption->id,
                'name' => $service['name'],
                'price_modifier' => $service['price_modifier'],
                'sort_order' => $index + 1
            ]);
        }

        // Seat Count Option
        $seatOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Jumlah Dudukan',
            'type' => 'select',
            'required' => true,
            'sort_order' => 2
        ]);

        $seats = [
            ['name' => '1 Seater', 'price_modifier' => 0],
            ['name' => '2 Seater', 'price_modifier' => 25000],
            ['name' => '3 Seater', 'price_modifier' => 50000],
            ['name' => 'L-Shape', 'price_modifier' => 75000],
            ['name' => 'Sectional', 'price_modifier' => 100000],
        ];

        foreach ($seats as $index => $seat) {
            ProductOptionValue::create([
                'product_option_id' => $seatOption->id,
                'name' => $seat['name'],
                'price_modifier' => $seat['price_modifier'],
                'sort_order' => $index + 1
            ]);
        }
    }

    private function createBabyOptions($product)
    {
        // Services Option
        $servicesOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Services',
            'type' => 'checkbox',
            'required' => true,
            'sort_order' => 1
        ]);

        $services = [
            ['name' => 'Gentle Baby-Safe Clean', 'price_modifier' => 30000],
            ['name' => 'Anti-Bacterial Treatment', 'price_modifier' => 40000],
            ['name' => 'Hypoallergenic Clean', 'price_modifier' => 50000],
        ];

        foreach ($services as $index => $service) {
            ProductOptionValue::create([
                'product_option_id' => $servicesOption->id,
                'name' => $service['name'],
                'price_modifier' => $service['price_modifier'],
                'sort_order' => $index + 1
            ]);
        }

        // Condition Option
        $conditionOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Kondisi',
            'type' => 'select',
            'required' => true,
            'sort_order' => 2
        ]);

        $conditions = [
            ['name' => 'Normal Cleaning', 'price_modifier' => 0],
            ['name' => 'Heavy Stains', 'price_modifier' => 20000],
            ['name' => 'Deep Sanitization', 'price_modifier' => 35000],
        ];

        foreach ($conditions as $index => $condition) {
            ProductOptionValue::create([
                'product_option_id' => $conditionOption->id,
                'name' => $condition['name'],
                'price_modifier' => $condition['price_modifier'],
                'sort_order' => $index + 1
            ]);
        }
    }

    private function createAddOnOptions($product)
    {
        // Services Option
        $servicesOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Services',
            'type' => 'checkbox',
            'required' => true,
            'sort_order' => 1
        ]);

        // Different services based on product name
        if (strpos(strtolower($product->name), 'car') !== false) {
            $services = [
                ['name' => 'Interior Vacuum', 'price_modifier' => 50000],
                ['name' => 'Seat Deep Clean', 'price_modifier' => 75000],
                ['name' => 'Dashboard Polish', 'price_modifier' => 30000],
                ['name' => 'Carpet Shampoo', 'price_modifier' => 60000],
            ];
        } elseif (strpos(strtolower($product->name), 'karpet') !== false) {
            $services = [
                ['name' => 'Deep Vacuum', 'price_modifier' => 25000],
                ['name' => 'Stain Treatment', 'price_modifier' => 40000],
                ['name' => 'Deodorizing', 'price_modifier' => 20000],
            ];
        } elseif (strpos(strtolower($product->name), 'gorden') !== false) {
            $services = [
                ['name' => 'Dust Removal', 'price_modifier' => 20000],
                ['name' => 'Fabric Refresh', 'price_modifier' => 35000],
                ['name' => 'Anti-Bacterial', 'price_modifier' => 30000],
            ];
        } else {
            $services = [
                ['name' => 'Standard Clean', 'price_modifier' => 15000],
                ['name' => 'Deep Clean', 'price_modifier' => 30000],
                ['name' => 'Sanitization', 'price_modifier' => 25000],
            ];
        }

        foreach ($services as $index => $service) {
            ProductOptionValue::create([
                'product_option_id' => $servicesOption->id,
                'name' => $service['name'],
                'price_modifier' => $service['price_modifier'],
                'sort_order' => $index + 1
            ]);
        }

        // Quantity Option
        $quantityOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Jumlah',
            'type' => 'select',
            'required' => true,
            'sort_order' => 2
        ]);

        $quantities = [
            ['name' => '1 Unit', 'price_modifier' => 0],
            ['name' => '2 Unit', 'price_modifier' => 15000],
            ['name' => '3 Unit', 'price_modifier' => 25000],
            ['name' => '4+ Unit', 'price_modifier' => 35000],
        ];

        foreach ($quantities as $index => $quantity) {
            ProductOptionValue::create([
                'product_option_id' => $quantityOption->id,
                'name' => $quantity['name'],
                'price_modifier' => $quantity['price_modifier'],
                'sort_order' => $index + 1
            ]);
        }
    }
}