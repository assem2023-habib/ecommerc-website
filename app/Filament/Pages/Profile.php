<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Actions\Action;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use BackedEnum;
use UnitEnum;

class Profile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = null;

    protected static string $view = 'filament.pages.profile';

    // protected static ?string $title = 'My Profile';

    protected static UnitEnum|string|null $navigationGroup = null;

    protected static ?int $navigationSort = null;

    public static function getRouteName(): string
    {
        return 'profile';
    }

    public function getTitle(): string
    {
        return 'My Profile';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Auth::user()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
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

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),

                Select::make('city_id')
                    ->label('City')
                    ->relationship('city', 'city_name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ])
                    ->required(),

                DatePicker::make('birthday')
                    ->label('Birthday')
                    ->native(false)
                    ->maxDate(now()),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->placeholder('+963 9XX XXX XXX')
                    ->maxLength(20),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->submit('save')
                ->icon('heroicon-o-check'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            $user = Auth::user();
            $user->update($data);

            Notification::make()
                ->title('Profile updated successfully!')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Error updating profile')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}