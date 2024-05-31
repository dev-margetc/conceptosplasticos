<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FranchiseResource\Pages;
use App\Filament\Resources\FranchiseResource\RelationManagers;
use App\Models\Franchise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class FranchiseResource extends Resource
{
    protected static ?string $model = Franchise::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Franchise info')
                ->description('You must fill out all fields')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('company_name')
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('country')
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('currency')
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('identification')
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('address')
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('zip_code')
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('brand_logo')
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('contact_phone')
                        ->tel()
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                    Forms\Components\TextInput::make('website_url')
                        ->maxLength(255)
                        ->default(null)
                        ->required(),
                ])
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('state')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('company_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('country')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('currency')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('identification')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('address')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('zip_code')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('brand_logo')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('contact_phone')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('email')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('website_url')
                //     ->searchable(),
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
            'index' => Pages\ListFranchises::route('/'),
            'create' => Pages\CreateFranchise::route('/create'),
            'edit' => Pages\EditFranchise::route('/{record}/edit'),
        ];
    }
}
