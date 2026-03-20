<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Experience Details')->schema([
                Forms\Components\TextInput::make('company')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('role')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->native(false),

                Forms\Components\DatePicker::make('end_date')
                    ->nullable()
                    ->native(false)
                    ->helperText('Leave empty if this is your current position.'),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('role')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('company')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->date('M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('M Y') : 'Present')
                    ->badge()
                    ->color(fn ($state) => $state ? 'gray' : 'success'),
            ])
            ->defaultSort('start_date', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit'   => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
