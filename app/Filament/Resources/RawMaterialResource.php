<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\RawMaterial;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RawMaterialResource\Pages;
use App\Filament\Resources\RawMaterialResource\RelationManagers;
use App\Models\Project;

class RawMaterialResource extends Resource
{
    protected static ?string $model = RawMaterial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Mix';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Materials')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('reference')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cost_kg')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('length')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('broad')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('height')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('client_id')
                            ->label('Project Name')
                            ->options(Project::whereNotNull('name')->pluck('name', 'id'))
                            ->searchable(),
                        // Forms\Components\Select::make('client_id')
                        // ->label('Project')
                        // ->relationship('client', 'project_name')
                        // ->getSearchResultsUsing(function (string $query) {
                        //     return Client::whereNotNull('project_name')
                        //         ->where('project_name', 'like', "%{$query}%")
                        //         ->pluck('project_name', 'id');
                        // })
                        // ->getOptionLabelUsing(function ($value) {
                        //     $client = \App\Models\Client::find($value);
                        //     return $client ? $client->project_name : null;
                        // })
                        //     ->label('project')
                        //     ->preload(),
                        // Forms\Components\TextInput::make('client_id')
                        //     ->numeric()
                        //     ->default(null),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cost_kg')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRawMaterials::route('/'),
            'create' => Pages\CreateRawMaterial::route('/create'),
            'edit' => Pages\EditRawMaterial::route('/{record}/edit'),
        ];
    }
}
