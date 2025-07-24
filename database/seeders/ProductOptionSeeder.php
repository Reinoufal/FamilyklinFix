<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use App\Models\ProductOptionValueCombination;

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

        // Setelah generate semua option, update harga (price_modifier) sesuai mapping
        $hargaMap = [
            // Kasur
            'Kasur Super King' => 350000,
            'Kasur King' => 300000,
            'Kasur Queen' => 250000,
            'Kasur Singel' => 150000,
            'Kasur Kecil' => 100000,
            // Sofa
            'Sofa Standart' => 50000,
            'Sofa Jumbo' => 100000,
            'Sofa Bed' => 75000,
            'Sofa L' => 120000,
            'Sofa Reclainer' => 95000,
            // Perlengkapan Bayi
            'Matras Bayi' => 25000,
            'Box Bayi' => 35000,
            'Stroler, Car seat' => 30000,
            'Bouncer' => 20000,
            // Add On (contoh)
            'Add On 1' => 15000,
            'Add On 2' => 20000,
        ];
        foreach ($hargaMap as $nama => $harga) {
            ProductOptionValue::where('name', $nama)->update(['price_modifier' => $harga]);
        }

        // Seeder kombinasi harga kasur, sofa, perlengkapan bayi, add on sesuai price list
        $hargaKombinasi = [
            // HYDROVACUUM
            'Hydrovacuum' => [
                'Kasur' => [
                    'Kasur Super King' => 170000,
                    'Kasur King' => 160000,
                    'Kasur Queen' => 150000,
                    'Kasur Singel' => 120000,
                    'Kasur Kecil' => 85000,
                ],
                'Sofa' => [
                    'Sofa Standart' => 50000,
                    'Sofa Jumbo' => 55000,
                    'Sofa Bed' => 125000,
                    'Sofa L' => 175000,
                    'Sofa Reclainer' => 75000,
                ],
                'Perlengkapan Bayi' => [
                    'Matras Bayi' => 60000,
                    'Box bayi' => 60000,
                    'Stroler,Car seat' => 50000,
                    'Bouncer' => 50000,
                ],
                'Add one' => [
                    'Kursi' => 30000,
                    'Karpet (m2)' => 15000,
                    'Tirai (m2)' => 10000,
                    'Car interior (5)seat' => 150000,
                    'Car intetior (8)seat' => 180000,
                    'Bantal / guling' => 5000,
                ],
            ],
            // CUCI KASUR
            'Cuci Kasur' => [
                'Kasur' => [
                    'Kasur Super King' => 350000,
                    'Kasur King' => 300000,
                    'Kasur Queen' => 260000,
                    'Kasur Singel' => 200000,
                    'Kasur Kecil' => 150000,
                ],
                'Sofa' => [
                    'Sofa Standart' => 65000,
                    'Sofa Jumbo' => 75000,
                    'Sofa Bed' => 200000,
                    'Sofa L' => 300000,
                    'Sofa Reclainer' => 95000,
                ],
                'Perlengkapan Bayi' => [
                    'Matras Bayi' => 100000,
                    'Box bayi' => 100000,
                    'Stroler,Car seat' => 80000,
                    'Bouncer' => 80000,
                ],
                'Add one' => [
                    'Kursi' => 35000,
                    'Karpet (m2)' => 25000,
                    'Tirai (m2)' => 20000,
                    'Car interior (5)seat' => 250000,
                    'Car intetior (8)seat' => 350000,
                    'Bantal / guling' => 15000,
                ],
            ],
        ];
        // Tambahkan harga kombinasi untuk Cuci Sofa (copy dari Cuci Kasur bagian Sofa)
        $hargaKombinasi['Cuci Sofa'] = [
            'Sofa' => $hargaKombinasi['Cuci Kasur']['Sofa'],
        ];

        // Mapping nama produk DB ke key array harga
        $mapping = [
            // Perlengkapan Bayi
            'Matras Bayi' => 'Matras Bayi',
            'Box Bayi' => 'Box bayi',
            'Stroler, Car seat' => 'Stroler,Car seat',
            'Bouncer' => 'Bouncer',
            // Add On
            'Kursi' => 'Kursi',
            'Karpet (m2)' => 'Karpet (m2)',
            'Tirai (m2)' => 'Tirai (m2)',
            'Car interior (5 seat)' => 'Car interior (5)seat',
            'Car interior (8 seat)' => 'Car intetior (8)seat',
            'Bantal / guling' => 'Bantal / guling',
        ];

        foreach ($products as $product) {
            $type = $product->type;
            if ($type === 'kasur' || $type === 'sofa' || $type === 'perlengkapan_bayi' || $type === 'add_on') {
                $layananOption = $product->options()->where('name', 'Layanan')->first();
                $ukuranOption = null;
                $typeLabel = '';
                $isSimple = false;
                if ($type === 'kasur') {
                    $ukuranOption = $product->options()->where('name', 'Ukuran Kasur')->first();
                    $typeLabel = 'Kasur';
                } elseif ($type === 'sofa') {
                    $ukuranOption = $product->options()->where('name', 'Jenis Sofa')->first();
                    $typeLabel = 'Sofa';
                } elseif ($type === 'perlengkapan_bayi') {
                    $ukuranOption = $product->options()->where('name', 'Dummy')->first();
                    $typeLabel = 'Perlengkapan Bayi';
                    $isSimple = true;
                } elseif ($type === 'add_on') {
                    $ukuranOption = $product->options()->where('name', 'Dummy')->first();
                    $typeLabel = 'Add one';
                    $isSimple = true;
                }
                if ($layananOption && $ukuranOption) {
                    foreach ($layananOption->values as $layananValue) {
                        $layananName = $layananValue->name;
                        if (!isset($hargaKombinasi[$layananName][$typeLabel])) continue;
                        if ($isSimple) {
                            // Satu opsi: gunakan dummy value milik produk ini
                            $dummyOption = $product->options()->where('name', 'Dummy')->first();
                            $ukuranValue = $dummyOption ? $dummyOption->values()->first() : null;
                            $keyNama = $mapping[$product->name] ?? $product->name;
                            $harga = $hargaKombinasi[$layananName][$typeLabel][$keyNama] ?? null;
                            if ($harga !== null && $ukuranValue) {
                                ProductOptionValueCombination::updateOrCreate([
                                    'product_id' => $product->id,
                                    'layanan_value_id' => $layananValue->id,
                                    'ukuran_value_id' => $ukuranValue->id,
                                ], [
                                    'price' => $harga
                                ]);
                            }
                        } else {
                            foreach ($ukuranOption->values as $ukuranValue) {
                                $ukuranName = $ukuranValue->name;
                                $harga = $hargaKombinasi[$layananName][$typeLabel][$ukuranName] ?? null;
                                if ($harga !== null) {
                                    ProductOptionValueCombination::updateOrCreate([
                                        'product_id' => $product->id,
                                        'layanan_value_id' => $layananValue->id,
                                        'ukuran_value_id' => $ukuranValue->id,
                                    ], [
                                        'price' => $harga
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
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
        // Opsi Layanan
        $layananOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Layanan',
            'type' => 'select',
            'required' => true,
            'sort_order' => 1
        ]);
        $layanans = [
            ['name' => 'Hydrovacuum'],
            ['name' => 'Cuci Kasur'],
        ];
        foreach ($layanans as $i => $layanan) {
            ProductOptionValue::create([
                'product_option_id' => $layananOption->id,
                'name' => $layanan['name'],
                'price_modifier' => 0,
                'sort_order' => $i + 1
            ]);
        }

        // Opsi Ukuran Kasur (SATU SAJA)
        $sizeOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Ukuran Kasur',
            'type' => 'select',
            'required' => true,
            'sort_order' => 2
        ]);
        $sizes = [
            ['name' => 'Kasur Super King'],
            ['name' => 'Kasur King'],
            ['name' => 'Kasur Queen'],
            ['name' => 'Kasur Singel'],
            ['name' => 'Kasur Kecil'],
        ];
        foreach ($sizes as $i => $size) {
            ProductOptionValue::create([
                'product_option_id' => $sizeOption->id,
                'name' => $size['name'],
                'price_modifier' => 0,
                'sort_order' => $i + 1
            ]);
        }
    }

    private function createSofaOptions($product)
    {
        // Opsi Layanan
        $layananOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Layanan',
            'type' => 'select',
            'required' => true,
            'sort_order' => 1
        ]);
        $layanans = [
            ['name' => 'Hydrovacuum'],
            ['name' => 'Cuci Sofa'],
        ];
        foreach ($layanans as $i => $layanan) {
            ProductOptionValue::create([
                'product_option_id' => $layananOption->id,
                'name' => $layanan['name'],
                'price_modifier' => 0,
                'sort_order' => $i + 1
            ]);
        }

        // Opsi Jenis Sofa
        $sofaOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Jenis Sofa',
            'type' => 'select',
            'required' => true,
            'sort_order' => 2
        ]);
        $sofas = [
            ['name' => 'Sofa Standart'],
            ['name' => 'Sofa Jumbo'],
            ['name' => 'Sofa Bed'],
            ['name' => 'Sofa L'],
            ['name' => 'Sofa Reclainer'],
        ];
        foreach ($sofas as $i => $sofaType) {
            ProductOptionValue::create([
                'product_option_id' => $sofaOption->id,
                'name' => $sofaType['name'],
                'price_modifier' => 0,
                'sort_order' => $i + 1
            ]);
        }
    }

    private function createBabyOptions($product)
    {
        // Opsi Layanan
        $layananOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Layanan',
            'type' => 'select',
            'required' => true,
            'sort_order' => 1
        ]);
        $layanans = [
            ['name' => 'Hydrovacuum'],
            ['name' => 'Cuci Kasur'],
        ];
        $layananIds = [];
        foreach ($layanans as $i => $layanan) {
            $val = ProductOptionValue::create([
                'product_option_id' => $layananOption->id,
                'name' => $layanan['name'],
                'price_modifier' => 0,
                'sort_order' => $i + 1
            ]);
            $layananIds[$layanan['name']] = $val->id;
        }
        // Value dummy untuk kombinasi harga
        $dummyOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Dummy',
            'type' => 'select',
            'required' => false,
            'sort_order' => 2
        ]);
        $dummyValue = ProductOptionValue::create([
            'product_option_id' => $dummyOption->id,
            'name' => '-',
            'price_modifier' => 0,
            'sort_order' => 1
        ]);
        // Simpan id dummy untuk kombinasi harga
        $product->dummy_option_id = $dummyOption->id;
        $product->dummy_value_id = $dummyValue->id;
    }

    private function createAddOnOptions($product)
    {
        // Opsi Layanan
        $layananOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Layanan',
            'type' => 'select',
            'required' => true,
            'sort_order' => 1
        ]);
        $layanans = [
            ['name' => 'Hydrovacuum'],
            ['name' => 'Cuci Kasur'],
            ];
        $layananIds = [];
        foreach ($layanans as $i => $layanan) {
            $val = ProductOptionValue::create([
                'product_option_id' => $layananOption->id,
                'name' => $layanan['name'],
                'price_modifier' => 0,
                'sort_order' => $i + 1
            ]);
            $layananIds[$layanan['name']] = $val->id;
        }
        // Value dummy untuk kombinasi harga
        $dummyOption = ProductOption::create([
            'product_id' => $product->id,
            'name' => 'Dummy',
            'type' => 'select',
            'required' => false,
            'sort_order' => 2
        ]);
        $dummyValue = ProductOptionValue::create([
            'product_option_id' => $dummyOption->id,
            'name' => '-',
            'price_modifier' => 0,
            'sort_order' => 1
        ]);
        $product->dummy_option_id = $dummyOption->id;
        $product->dummy_value_id = $dummyValue->id;
    }
}