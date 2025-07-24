<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class SalesStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        return [
            Stat::make('Total Penjualan', 'Rp ' . number_format(Order::sum('total_price'), 0, ',', '.'))
                ->description('Semua waktu')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Penjualan Bulan Ini', 'Rp ' . number_format(Order::whereMonth('created_at', $thisMonth->month)->sum('total_price'), 0, ',', '.'))
                ->description('Bulan ' . $thisMonth->format('F Y'))
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('primary'),

            Stat::make('Penjualan Hari Ini', 'Rp ' . number_format(Order::whereDate('created_at', $today)->sum('total_price'), 0, ',', '.'))
                ->description('Hari ' . $today->format('d M Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),

            Stat::make('Total Order', Order::count())
                ->description('Semua order')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),

            Stat::make('Order Bulan Ini', Order::whereMonth('created_at', $thisMonth->month)->count())
                ->description('Bulan ' . $thisMonth->format('F Y'))
                ->descriptionIcon('heroicon-m-document-text')
                ->color('gray'),

            Stat::make('Order Pending', Order::where('status', 'pending')->count())
                ->description('Menunggu verifikasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('danger'),
        ];
    }
} 