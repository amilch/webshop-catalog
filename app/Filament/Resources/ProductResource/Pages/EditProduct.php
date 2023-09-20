<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\AttributeValue;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        foreach($this->record->attributeValues as $attrValue) {
            $data['attr-' . $attrValue->attribute_id] = $attrValue->id;
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->attributeValues()->detach();

        foreach ($data as $key => $value) {
            if (str_starts_with($key, 'attr-')) {
                if (! is_null($value)) {
                    $record->attributeValues()->attach($value);
                }
                unset($data[$key]);
            }
        }
        $record->update($data);

        return $record;
    }
}
