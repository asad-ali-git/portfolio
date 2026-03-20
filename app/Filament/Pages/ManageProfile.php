<?php

namespace App\Filament\Pages;

use App\Models\Profile;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon  = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?int    $navigationSort  = 0;
    protected static ?string $title           = 'Profile';
    protected static string  $view            = 'filament.pages.manage-profile';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Profile::instance()->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identity')->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(100)
                        ->placeholder('Asad Ali'),

                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Senior Full-Stack Engineer'),

                    Forms\Components\TextInput::make('subtitle')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Laravel & Vue 3'),

                    Forms\Components\Textarea::make('tagline')
                        ->required()
                        ->rows(2)
                        ->columnSpanFull()
                        ->placeholder('Building systems that scale, interfaces that feel intentional.'),
                ])->columns(2),

                Forms\Components\Section::make('About')->schema([
                    Forms\Components\Textarea::make('bio')
                        ->rows(10)
                        ->columnSpanFull()
                        ->helperText('Separate paragraphs with a blank line (double Enter).')
                        ->placeholder("I'm a senior full-stack engineer…\n\nI believe in clean boundaries between concerns…"),

                    Forms\Components\TagsInput::make('tags')
                        ->placeholder('Add tag…')
                        ->helperText('Chips shown in the About section.')
                        ->columnSpanFull(),
                ]),

                Forms\Components\Section::make('Contact & Presence')->schema([
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('location')
                        ->maxLength(100)
                        ->placeholder('Pakistan'),

                    Forms\Components\TextInput::make('availability')
                        ->maxLength(255)
                        ->placeholder('Available for work · Remote / Pakistan')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('github_url')
                        ->label('GitHub URL')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('linkedin_url')
                        ->label('LinkedIn URL')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('resume_url')
                        ->label('Resume URL')
                        ->url()
                        ->nullable()
                        ->maxLength(255),
                ])->columns(2),

                Forms\Components\Section::make('Stats')->schema([
                    Forms\Components\TextInput::make('years_of_experience')
                        ->label('Years of experience')
                        ->numeric()
                        ->minValue(0)
                        ->required(),

                    Forms\Components\TextInput::make('open_source_commits')
                        ->label('Open-source commits')
                        ->numeric()
                        ->minValue(0)
                        ->default(0),
                ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Profile::instance()->update($data);

        Notification::make()
            ->title('Profile saved.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save changes')
                ->color('primary')
                ->action('save'),
        ];
    }
}
