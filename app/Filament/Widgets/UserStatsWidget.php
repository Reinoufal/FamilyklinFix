<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Semua user terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Admin Users', User::where('is_admin', true)->count())
                ->description('User dengan akses admin')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('warning'),

            Stat::make('Verified Users', User::whereNotNull('email_verified_at')->count())
                ->description('User dengan email terverifikasi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Active Users', User::whereHas('orders')->count())
                ->description('User yang pernah order')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),
        ];
    }
} 