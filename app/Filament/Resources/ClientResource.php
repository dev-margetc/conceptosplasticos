<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Client;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ProjectStatus;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ClientResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Filament\Resources\ClienteResource\Actions\CreateClientHistoryAction;
use App\Filament\Resources\ClienteResource\Actions\ViewHistoryAction;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'CRM';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Client info')
                ->description('You must fill out all fields')
                ->columns(2)
                ->schema([
                    Forms\Components\Select::make('country_id')
                        ->relationship(name: 'country', titleAttribute: 'name')
                        ->required()
                        ->preload(),
                    TextInput::make('business_type')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('customer_type')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->tel()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('address')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('lead_origin')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('project_name')
                        ->maxLength(255),
                    //campos del historial del cliente
                    Forms\Components\Select::make('project_status_id')
                        ->label('status')
                        ->options(ProjectStatus::all()->pluck('description', 'id'))
                        ->hiddenOn('edit')
                        ->required(),
                    Forms\Components\Textarea::make('comments')
                        ->label('Comentarios')
                        ->columnSpanFull()
                        ->hiddenOn('edit')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('project_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latest_project_status.description')
                    ->label('Status')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('information'),
                    CreateClientHistoryAction::make('create_history'),
                    ViewHistoryAction::make('view_history'),
                    // Action::make('view')
                    //     ->label('view log')
                    //     ->icon('heroicon-s-eye'),
                    Tables\Actions\DeleteAction::make(),
                ])->iconButton()->button()
                ->label('Actions')
                ->color('gray')
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
