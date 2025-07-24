<?php

namespace App\Filament\Resources\ProductOptionValueResource\Pages;

use App\Filament\Resources\ProductOptionValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductOptionValues extends ListRecords
{
    protected static string $resource = ProductOptionValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Nilai Opsi'),
        ];
    }
} 