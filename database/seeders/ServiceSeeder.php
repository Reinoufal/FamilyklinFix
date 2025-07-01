<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Hydrocleaning Rumah Tinggal',
                'description' => 'Layanan pembersihan rumah tinggal menggunakan teknologi hydrocleaning untuk hasil maksimal. Meliputi pembersihan lantai, dinding, dan furniture.',
                'price' => 250000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hydrocleaning Kantor',
                'description' => 'Pembersihan kantor profesional dengan teknologi hydrocleaning. Meliputi area kerja, ruang meeting, dan fasilitas umum.',
                'price' => 400000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Deep Cleaning Kamar Mandi',
                'description' => 'Pembersihan mendalam kamar mandi dengan teknologi hydrocleaning untuk menghilangkan kerak, jamur, dan bakteri.',
                'price' => 150000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembersihan Karpet & Sofa',
                'description' => 'Layanan pembersihan karpet dan sofa menggunakan hydrocleaning untuk menghilangkan noda, debu, dan tungau.',
                'price' => 200000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hydrocleaning Dapur',
                'description' => 'Pembersihan dapur menyeluruh termasuk kompor, exhaust fan, lemari, dan peralatan dapur lainnya.',
                'price' => 180000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembersihan Jendela & Kaca',
                'description' => 'Layanan pembersihan jendela dan kaca menggunakan teknologi hydrocleaning untuk hasil bening dan bebas noda.',
                'price' => 100000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hydrocleaning Toko/Retail',
                'description' => 'Pembersihan toko dan area retail untuk menjaga kebersihan dan kenyamanan pelanggan.',
                'price' => 350000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembersihan AC & Ventilasi',
                'description' => 'Layanan pembersihan AC dan sistem ventilasi menggunakan hydrocleaning untuk udara yang lebih bersih.',
                'price' => 120000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hydrocleaning Restoran',
                'description' => 'Pembersihan restoran dan area food service dengan standar kebersihan tinggi menggunakan teknologi hydrocleaning.',
                'price' => 500000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembersihan Gudang/Warehouse',
                'description' => 'Layanan pembersihan gudang dan warehouse untuk menjaga kebersihan area penyimpanan barang.',
                'price' => 600000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hydrocleaning Post Construction',
                'description' => 'Pembersihan pasca konstruksi untuk menghilangkan debu, sisa material, dan kotoran dari proses pembangunan.',
                'price' => 800000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembersihan Tangki Air',
                'description' => 'Layanan pembersihan dan disinfeksi tangki air menggunakan teknologi hydrocleaning untuk air yang lebih bersih.',
                'price' => 300000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hydrocleaning Apartemen',
                'description' => 'Pembersihan apartemen menyeluruh dengan teknologi hydrocleaning untuk hunian yang bersih dan sehat.',
                'price' => 280000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pembersihan Kolam Renang',
                'description' => 'Layanan pembersihan kolam renang termasuk dinding, lantai, dan sistem filtrasi menggunakan hydrocleaning.',
                'price' => 450000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maintenance Cleaning Bulanan',
                'description' => 'Paket maintenance cleaning bulanan untuk menjaga kebersihan rutin dengan teknologi hydrocleaning.',
                'price' => 1200000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        // Layanan Cuci Biasa
            [
                'name' => 'Cuci Mobil Reguler',
                'description' => 'Layanan cuci mobil standar dengan sabun dan air biasa. Meliputi pembersihan eksterior dan interior dasar.',
                'price' => 50000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuci Motor Standar',
                'description' => 'Pembersihan motor dengan metode cuci biasa menggunakan sabun dan air. Termasuk pembersihan body dan velg.',
                'price' => 25000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuci Sepatu Reguler',
                'description' => 'Layanan cuci sepatu dengan metode manual menggunakan sikat dan deterjen khusus sepatu.',
                'price' => 30000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuci Tas & Ransel',
                'description' => 'Pembersihan tas dan ransel dengan metode cuci manual yang aman untuk berbagai jenis bahan.',
                'price' => 40000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuci Helm Standar',
                'description' => 'Layanan cuci helm dengan pembersihan dalam dan luar menggunakan sabun antibakteri.',
                'price' => 20000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('services')->insert($services);
    }
}