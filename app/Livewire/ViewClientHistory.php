<?php

namespace App\Livewire;

use App\Models\ClientHistory;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ViewClientHistory extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $clientId;

    // protected function getTableQuery()
    // {
    //     return ClientHistory::query()
    //         ->where('client_id', $this->clientId)
    //         ->with('projectStatus', 'user');
    // }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ClientHistory::query()
                    ->where('client_id', $this->clientId)
                    ->with('projectStatus', 'user')
            )
            ->columns([
                TextColumn::make('created_at')
                    ->label('Date')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                TextColumn::make('projectStatus.description')
                    ->label('Status')
                    ->sortable(),
                TextColumn::make('comments')
                    ->label('Comments')
                    ->sortable(),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.view-client-history');
    }
}
