<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComponentsRelationManager extends RelationManager
{
    protected static string $relationship = 'components';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('default')
                    ->required()
                    ->default(false),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price_change')
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\TextInput::make('shipping_weight')
                    ->numeric()
                    ->prefix('g'),
                Forms\Components\TextInput::make('shipping_width')
                    ->numeric()
                    ->prefix('cm'),
                Forms\Components\TextInput::make('shipping_height')
                    ->numeric()
                    ->prefix('cm'),
                Forms\Components\TextInput::make('shipping_depth')
                    ->numeric()
                    ->prefix('cm'),
                Select::make('option_id')
                    ->relationship('option', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->defaultGroup('option.name')
            ->columns([
                Tables\Columns\TextColumn::make('option.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\CheckboxColumn::make('default')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('option')
                    ->relationship('option', 'name')
                    ->preload()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->recordSelect(
                        fn (Select $select) => $select
                            ->multiple()
                    )
                    ->preloadRecordSelect(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
