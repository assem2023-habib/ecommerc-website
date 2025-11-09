<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Forms\Components\PhoneNumber;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Grid::make()
                    ->columnSpanFull()
                    ->gridContainer()
                    ->columns([
                        '@md' => 3,
                        '@xl' => 2,
                        '!@md' => 4,
                        '!@xl' => 4,
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('user_name')
                            ->label('Username')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                    ]),

                Grid::make()
                    ->columnSpanFull()
                    ->gridContainer()
                    ->columns([
                        '@md' => 3,
                        '@xl' => 2,
                        '!@md' => 4,
                        '!@xl' => 4,
                    ])
                    ->schema([
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->minLength(8),

                    ]),

                Grid::make()
                    ->columnSpanFull()
                    ->gridContainer()
                    ->columns([
                        '@md' => 3,
                        '@xl' => 2,
                        '!@md' => 4,
                        '!@xl' => 4,
                    ])
                    ->schema([
                        Select::make('city_id')
                            ->label('City')
                            ->relationship('city', 'city_name')
                            ->searchable()
                            ->required(),

                        Select::make('gender')
                            ->label('Gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                            ])
                            ->default(null),
                    ]),

                Grid::make()
                    ->columnSpanFull()
                    ->gridContainer()
                    ->columns([
                        '@md' => 3,
                        '@xl' => 2,
                        '!@md' => 4,
                        '!@xl' => 4,
                    ])
                    ->schema([
                        DatePicker::make('birthday')
                            ->label('Birthday')
                            ->native(false),
                        PhoneNumber::make('phone', 'Phone Number'),

                    ]),
            ]);
    }
}
