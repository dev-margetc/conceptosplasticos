<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Machine;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MachineResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MachineResource\RelationManagers;

class MachineResource extends Resource
{
    protected static ?string $model = Machine::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Initial Setup';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Machine info')
                ->description('You must fill out all fields')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->maxLength(255)
                        ->required(),
                    Forms\Components\TextInput::make('capacity')
                        ->maxLength(255)
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('machine name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('capacity kg/h')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('status'),
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
            'index' => Pages\ListMachines::route('/'),
            'create' => Pages\CreateMachine::route('/create'),
            'edit' => Pages\EditMachine::route('/{record}/edit'),
        ];
    }
}
