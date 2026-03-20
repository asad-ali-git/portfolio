<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Automatically mark as read when viewed
        $this->record->update(['is_read' => true]);

        return $data;
    }
}
