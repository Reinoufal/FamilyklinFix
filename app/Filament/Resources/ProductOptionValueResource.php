<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductOptionValueResource\Pages;
use App\Models\ProductOptionValue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductOptionValueResource extends Resource
{
    protected static ?string $model = ProductOptionValue::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Produk';

    protected static ?string $navigationLabel = 'Nilai Opsi Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_option_id')
                    ->relationship('option', 'name')
                    ->required()
                    ->label('Opsi Produk')
                    ->searchable(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama Nilai')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price_modifier')
                    ->numeric()
                    ->default(0)
                    ->label('Modifier Harga')
                    ->helperText('Harga tambahan untuk opsi ini')
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->label('Urutan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('option.name')
                    ->label('Opsi Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Nilai')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_modifier')
                    ->label('Modifier Harga')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('product_option_id')
                    ->relationship('option', 'name')
                    ->label('Filter Opsi Produk'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductOptionValues::route('/'),
            'create' => Pages\CreateProductOptionValue::route('/create'),
            'edit' => Pages\EditProductOptionValue::route('/{record}/edit'),
        ];
    }
} 