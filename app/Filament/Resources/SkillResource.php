<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(100),

            Forms\Components\Select::make('category')
                ->required()
                ->options(array_combine(Skill::categories(), Skill::categories())),

            Forms\Components\TextInput::make('level')
                ->required()
                ->numeric()
                ->minValue(1)
                ->maxValue(100)
                ->suffix('%')
                ->default(80),

            Forms\Components\TextInput::make('sort_order')
                ->numeric()
                ->default(0)
                ->minValue(0),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary'   => 'Frontend',
                        'success'   => 'Backend',
                        'warning'   => 'Tools',
                        'danger'    => 'Database',
                    ]),

                Tables\Columns\TextColumn::make('level')
                    ->suffix('%')
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options(array_combine(Skill::categories(), Skill::categories())),
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
            ->defaultSort('sort_order');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit'   => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
