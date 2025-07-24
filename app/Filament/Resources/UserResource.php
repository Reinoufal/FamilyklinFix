<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Manajemen User';
    protected static ?string $modelLabel = 'User';
    protected static ?string $pluralModelLabel = 'Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->maxLength(500),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Keamanan')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->rules([
                                Password::min(8)
                                    ->letters()
                                    ->mixedCase()
                                    ->numbers()
                                    ->symbols()
                            ])
                            ->confirmed(),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrated(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status & Verifikasi')
                    ->schema([
                        Forms\Components\Toggle::make('email_verified_at')
                            ->label('Email Terverifikasi')
                            ->dehydrateStateUsing(fn ($state) => $state ? now() : null)
                            ->dehydrated(fn ($state) => filled($state)),
                        Forms\Components\Toggle::make('is_admin')
                            ->label('Admin')
                            ->helperText('User dengan akses admin dapat mengelola sistem'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable(),
                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Email Terverifikasi')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean()
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-user')
                    ->trueColor('warning')
                    ->falseColor('gray'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('orders_count')
                    ->label('Total Order')
                    ->counts('orders')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('email_verified')
                    ->label('Email Terverifikasi')
                    ->query(fn ($query) => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('admin_only')
                    ->label('Admin Saja')
                    ->query(fn ($query) => $query->where('is_admin', true)),
                Tables\Filters\Filter::make('has_orders')
                    ->label('Punya Order')
                    ->query(fn ($query) => $query->has('orders')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('verify_email')
                    ->label('Verifikasi Email')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (User $user) {
                        $user->email_verified_at = now();
                        $user->save();
                    })
                    ->visible(fn (User $user) => !$user->email_verified_at),
                Tables\Actions\Action::make('toggle_admin')
                    ->label(fn (User $user) => $user->is_admin ? 'Hapus Admin' : 'Jadikan Admin')
                    ->icon(fn (User $user) => $user->is_admin ? 'heroicon-o-user' : 'heroicon-o-shield-check')
                    ->color(fn (User $user) => $user->is_admin ? 'danger' : 'warning')
                    ->action(function (User $user) {
                        $user->is_admin = !$user->is_admin;
                        $user->save();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('verify_emails')
                        ->label('Verifikasi Email Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->action(function ($records) {
                            $records->each(function ($user) {
                                $user->email_verified_at = now();
                                $user->save();
                            });
                        }),
                    Tables\Actions\BulkAction::make('make_admin')
                        ->label('Jadikan Admin')
                        ->icon('heroicon-o-shield-check')
                        ->action(function ($records) {
                            $records->each(function ($user) {
                                $user->is_admin = true;
                                $user->save();
                            });
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
