<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Infrastructure\Persistence\Eloquent\Models\User;
use Illuminate\Notifications\Notification;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('city_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user_name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('birthday')
                    ->date()
                    ->sortable(),
                TextColumn::make('gender')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('toggleAdmin')
                    ->label(fn(User $record) => $record->hasRole('admin') ? 'إزالة الأدمن' : 'ترقية إلى أدمن')
                    ->icon(fn(User $record) => $record->hasRole('admin') ? 'heroicon-o-shield-exclamation' : 'heroicon-o-shield-check')
                    ->color(fn(User $record) => $record->hasRole('admin') ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->action(function (User $record): void {
                        if ($record->hasRole('admin')) {
                            $record->removeRole('admin');
                            \Filament\Notifications\Notification::make()
                                ->title('تمت إزالة صلاحية الأدمن')
                                ->success()
                                ->send();
                        } else {
                            $record->assignRole('admin');
                            \Filament\Notifications\Notification::make()
                                ->title('تمت ترقية المستخدم إلى أدمن')
                                ->success()
                                ->send();
                        }
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
