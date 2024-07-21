<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FirmaResource\Pages;
use App\Filament\Resources\FirmaResource\RelationManagers;
use App\Models\Firma;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Savannabits\SignaturePad\Forms\Components\Fields\SignaturePad;

class FirmaResource extends Resource
{
    protected static ?string $model = Firma::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                SignaturePad::make('signature')
                    ->hideDownloadButtons(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                // Tables\Columns\ImageColumn::make('signature'),
                // Tables\Columns\TextColumn::make('signature'),
                Tables\Columns\ViewColumn::make('signature')
                    ->view('tables.columns.signature')
                    ->label('Signature'),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListFirmas::route('/'),
            'create' => Pages\CreateFirma::route('/create'),
            'edit' => Pages\EditFirma::route('/{record}/edit'),
        ];
    }    
}
