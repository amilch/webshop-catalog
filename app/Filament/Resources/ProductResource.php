<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\AttributeValue;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Component;
use Livewire\Livewire;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Toggle::make('visible')
                    ->default(true)
                    ->required()
                    ->columnSpanFull(),
                Select::make('product_type_id')
                    ->relationship('productType', 'name')
                    ->required()
                    ->disabledOn('edit'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('default_price')
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\TextInput::make('default_weight')
                    ->numeric()
                    ->prefix('g'),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                    ->multiple()
                    ->reorderable()
                    ->columnSpanFull(),
                Forms\Components\Section::make('Attributes')
                    ->hiddenOn('create')
                    ->schema(fn (?Model $record, String $operation) =>
                        $operation == 'create' ? [] :
                            $record->productType->attributes()
                                ->where('use_as_variant', false)
                                ->with('values')->get()->map(fn ($attr) =>
                                    Select::make('attr-' . $attr->id)
                                        ->label($attr->name)
                                        ->options( $attr->values()->pluck('value', 'id'))
                                        ->searchable()
                                )->toArray()
                    )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\CheckboxColumn::make('visible')
                    ->sortable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('images'),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('productType.name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->preload()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VariantRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
