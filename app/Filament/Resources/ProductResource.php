<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nama Produk'),
                Textarea::make('description')
                    ->required()
                    ->label('Deskripsi'),
                TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->label('Harga'),
                Select::make('categories')
                    ->options([
                        'hydrovaccum' => 'Hydrovaccum',
                        'cuci' => 'Cuci',
        // tambahkan opsi lain jika diperlukan
                    ])
                    ->required()
                    ->label('Kategori Layanan'),
                Select::make('size')
                    ->options([
                        // Kasur sizes
                        'super_king' => 'Super King',
                        'king' => 'King',
                        'queen' => 'Queen',
                        'single' => 'Single',
                        'kecil' => 'Kecil',
                        // Sofa sizes
                        'standard' => 'Standard',
                        'jumbo' => 'Jumbo',
                        'bed' => 'Bed',
                        'L_shape' => 'L Shape',
                        'recliner' => 'Recliner'
                    ])
                    ->label('Ukuran'),
                TextInput::make('seat_count')
                    ->numeric()
                    ->label('Jumlah Kursi')
                    ->helperText('Khusus untuk sofa'),
                TextInput::make('unit')
                    ->label('Unit')
                    ->helperText('Contoh: m2'),
                FileUpload::make('image')
                    ->image()
                    ->directory('products')
                    ->preserveFilenames()
                    ->maxSize(2048)
                    ->disk('public')
                    ->visibility('public')
                    ->imageResizeMode('contain')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->label('Gambar Produk'),
                Toggle::make('is_available')
                    ->default(true)
                    ->label('Tersedia'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar'),
                Tables\Columns\IconColumn::make('is_available')
                    ->label('Tersedia')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
