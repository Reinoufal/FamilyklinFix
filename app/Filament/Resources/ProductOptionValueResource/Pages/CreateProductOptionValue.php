<?php

namespace App\Filament\Resources\ProductOptionValueResource\Pages;

use App\Filament\Resources\ProductOptionValueResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;
use Filament\Resources\Pages\create;


class CreateProductOptionValue extends CreateRecord
{
    protected static string $resource = ProductOptionValueResource::class;
}
