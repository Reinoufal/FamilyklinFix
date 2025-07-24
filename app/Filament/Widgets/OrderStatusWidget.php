<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class OrderStatusWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 5;

    public function getHeading(): ?string
    {
        return 'Status Order';
    }

    protected function getData(): array
    {
        $pending = Order::where('status', 'pending')->count();
        $verified = Order::where('status', 'verified')->count();
        $cancelled = Order::where('status', 'cancelled')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Status Order',
                    'data' => [$pending, $verified, $cancelled],
                    'backgroundColor' => [
                        '#f59e0b', // warning - pending
                        '#10b981', // success - verified
                        '#ef4444', // danger - cancelled
                    ],
                    'borderColor' => [
                        '#f59e0b',
                        '#10b981',
                        '#ef4444',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => [
                'Pending (' . $pending . ')',
                'Verified (' . $verified . ')',
                'Cancelled (' . $cancelled . ')',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
} 