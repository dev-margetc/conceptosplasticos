<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Filament\Forms\Form;
use App\Models\Component;
use Filament\Tables\Table;
use App\Models\RawMaterial;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ComponentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ComponentResource\RelationManagers;
use App\Filament\Resources\ComponentResource\Actions\CreateComponentHistoryAction;

class ComponentResource extends Resource
{
    protected static ?string $model = Component::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Inventary';
    protected static ?string $label = 'Inventary';
    protected static ?int $navigationSort = 4;

    private static function getMaterialSchemas(): array
    {
        $rawMaterials = RawMaterial::all();
        $materialSchemas = [];

        foreach ($rawMaterials as $rawMaterial) {
            $materialSchemas[] = Forms\Components\TextInput::make('raw_materials.' . $rawMaterial->id . '.percentage')
                ->label($rawMaterial->name)
                ->placeholder('Porcentaje')
                ->type('number');
        }

        return $materialSchemas;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Component info')
                    ->description('You must fill out all fields')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('group_id')
                            ->relationship(name: 'group', titleAttribute: 'description')
                            ->required(),
                    ]),
                Section::make('select mix')
                    ->columns(3)
                    ->schema(self::getMaterialSchemas())
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        $in = "";
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Group')->sortable(),
                Tables\Columns\IconColumn::make('Mix')
                    ->label('Mix')
                    ->icon('heroicon-o-clock')
                    ->color('warning')
                    ->size(Tables\Columns\IconColumn\IconColumnSize::Medium)
                    ->tooltip(fn ($record) => 'Información del Mix'),
                Tables\Columns\TextColumn::make('stock')
                    ->default(0),
                Tables\Columns\TextInputColumn::make('in')
                    ->label('IN')
                    ->updateStateUsing(function ($record, $state) {
                        $record->in =  $state;
                    }),
                Tables\Columns\TextInputColumn::make('out')
                    ->label('OUT')
                    ->default('')
                    ->sortable()
                    ->searchable(),
                    Tables\Columns\SelectColumn::make('project_id')
                    ->label('Project')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->default(null)
                    ->searchable()
                    ->updateStateUsing(function ($record, $state) {
                        $record->project_id = $state;
                        $record->save();
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                CreateComponentHistoryAction::make('register'),
                Tables\Actions\Action::make('view_log')
                    ->label('View Log')
                    ->button()
                    ->action(function (Component $record) {
                        // Lógica para ver el log aquí
                    }),
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
            'index' => Pages\ListComponents::route('/'),
            'create' => Pages\CreateComponent::route('/create'),
            'edit' => Pages\EditComponent::route('/{record}/edit'),
        ];
    }
}
