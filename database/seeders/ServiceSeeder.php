<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Hydrovaccum',
                'description' => 'Layanan pembersihan menyeluruh menggunakan teknologi hydrovaccum untuk rumah, kantor, dan area lainnya.',
                'price' => 250000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cuci',
                'description' => 'Layanan cuci untuk mobil, motor, sepatu, helm, dan barang lainnya dengan metode standar dan aman.',
                'price' => 50000.00,
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}