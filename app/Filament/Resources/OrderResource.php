<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Transaksi';
    protected static ?string $navigationLabel = 'Pesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_code')
                    ->label('Kode Order')
                    ->disabled(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Pelanggan')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->label('Email Pelanggan')
                    ->disabled(),
                Forms\Components\TextInput::make('total_price')
                    ->label('Total Harga')
                    ->disabled(),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'cash' => 'COD',
                        'transfer' => 'QRIS',
                    ])
                    ->label('Metode Pembayaran')
                    ->disabled(),
                Forms\Components\TextInput::make('shipping_address')
                    ->label('Alamat Pengiriman')
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'verified' => 'Verified',
                        'cancelled' => 'Cancelled',
                    ])
                    ->label('Status')
                    ->required(),
                Forms\Components\DateTimePicker::make('placed_at')
                    ->label('Tanggal Order')
                    ->disabled(),
                Forms\Components\Section::make('Rincian Pembelian')
                    ->schema([
                        Forms\Components\View::make('filament.resources.order-resource.partials.order-items')
                            ->label(false),
                        Forms\Components\View::make('filament.resources.order-resource.partials.qris-proof')
                            ->label('Bukti Pembayaran QRIS')
                            ->visible(fn($record) => $record && $record->qris_proof),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('order_code')->label('Kode Order')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Pelanggan')->sortable(),
                Tables\Columns\TextColumn::make('user.email')->label('Email')->sortable(),
                Tables\Columns\TextColumn::make('total_price')->label('Total Harga')->money('idr')->sortable(),
                Tables\Columns\TextColumn::make('payment_method')->label('Metode Pembayaran')->sortable(),
                Tables\Columns\TextColumn::make('status')->label('Status')->badge()->sortable(),
                Tables\Columns\TextColumn::make('placed_at')->label('Tanggal Order')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('verifikasi')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function ($record) {
                        $record->status = 'verified';
                        $record->save();
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
