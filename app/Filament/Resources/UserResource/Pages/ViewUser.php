<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('verify_email')
                ->label('Verifikasi Email')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function () {
                    $this->record->email_verified_at = now();
                    $this->record->save();
                })
                ->visible(fn () => !$this->record->email_verified_at),
            Actions\Action::make('toggle_admin')
                ->label(fn () => $this->record->is_admin ? 'Hapus Admin' : 'Jadikan Admin')
                ->icon(fn () => $this->record->is_admin ? 'heroicon-o-user' : 'heroicon-o-shield-check')
                ->color(fn () => $this->record->is_admin ? 'danger' : 'warning')
                ->action(function () {
                    $this->record->is_admin = !$this->record->is_admin;
                    $this->record->save();
                }),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nama Lengkap'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email'),
                        Infolists\Components\TextEntry::make('phone')
                            ->label('Nomor Telepon'),
                        Infolists\Components\TextEntry::make('address')
                            ->label('Alamat')
                            ->markdown(),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Status & Verifikasi')
                    ->schema([
                        Infolists\Components\IconEntry::make('email_verified_at')
                            ->label('Email Terverifikasi')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                        Infolists\Components\IconEntry::make('is_admin')
                            ->label('Admin')
                            ->boolean()
                            ->trueIcon('heroicon-o-shield-check')
                            ->falseIcon('heroicon-o-user')
                            ->trueColor('warning')
                            ->falseColor('gray'),
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Terdaftar')
                            ->dateTime('d M Y H:i'),
                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Terakhir Update')
                            ->dateTime('d M Y H:i'),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Riwayat Order')
                    ->schema([
                        Infolists\Components\TextEntry::make('orders_count')
                            ->label('Total Order')
                            ->state(fn () => $this->record->orders()->count()),
                        Infolists\Components\TextEntry::make('total_spent')
                            ->label('Total Pengeluaran')
                            ->state(fn () => 'Rp ' . number_format($this->record->orders()->sum('total_price'), 0, ',', '.')),
                    ])
                    ->columns(2)
                    ->visible(fn () => $this->record->orders()->count() > 0),
            ]);
    }
}
