<?php

namespace App\Filament\Resources\ProductOptionValueResource\Pages;

use App\Filament\Resources\ProductOptionValueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductOptionValue extends EditRecord
{
    protected static string $resource = ProductOptionValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
} 