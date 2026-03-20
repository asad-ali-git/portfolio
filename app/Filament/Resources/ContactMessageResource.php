<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Messages';

    /**
     * Show unread count as badge in navigation.
     */
    public static function getNavigationBadge(): ?string
    {
        $count = ContactMessage::unread()->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make()->schema([
                Infolists\Components\TextEntry::make('name')->weight('bold'),
                Infolists\Components\TextEntry::make('email'),
                Infolists\Components\TextEntry::make('created_at')->label('Received')->dateTime(),
                Infolists\Components\TextEntry::make('message')->columnSpanFull(),
            ])->columns(3),
        ]);
    }

    public static function form(Form $form): Form
    {
        // Read-only in admin — messages only created via public API
        return $form->schema([
            Forms\Components\TextInput::make('name')->disabled(),
            Forms\Components\TextInput::make('email')->disabled(),
            Forms\Components\Textarea::make('message')->disabled()->columnSpanFull(),
            Forms\Components\Toggle::make('is_read')->label('Mark as read'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('message')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->message),

                Tables\Columns\IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')->label('Read'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('mark_read')
                    ->label('Mark Read')
                    ->icon('heroicon-o-check')
                    ->action(fn ($record) => $record->update(['is_read' => true]))
                    ->hidden(fn ($record) => $record->is_read),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view'  => Pages\ViewContactMessage::route('/{record}'),
        ];
    }
}
