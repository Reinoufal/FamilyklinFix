<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class TopProductsWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    public function getHeading(): string
    {
        return 'Produk Terlaris';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->orderBy('sold', 'desc')
                    ->limit(5)
            )
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular()
                    ->size(40),
                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr')
                    ->sortable(),
                TextColumn::make('sold')
                    ->label('Terjual')
                    ->sortable()
                    ->badge()
                    ->color('success'),
                TextColumn::make('stock')
                    ->label('Stok')
                    ->sortable()
                    ->badge()
                    ->color(fn (Product $record): string => $record->stock > 10 ? 'success' : ($record->stock > 0 ? 'warning' : 'danger')),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Product $record): string => route('filament.admin.resources.products.edit', $record))
                    ->openUrlInNewTab(),
            ]);
    }
} 