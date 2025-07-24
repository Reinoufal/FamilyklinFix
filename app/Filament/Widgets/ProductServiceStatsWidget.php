<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductServiceStatsWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    public function getHeading(): string
    {
        return 'Produk & Layanan';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Semua produk')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),

            Stat::make('Total Layanan', Service::count())
                ->description('Semua layanan')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('success'),

            Stat::make('Produk Tersedia', Product::where('stock', '>', 0)->count())
                ->description('Produk dengan stok')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),

            Stat::make('Produk Habis', Product::where('stock', 0)->count())
                ->description('Produk tanpa stok')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
} 