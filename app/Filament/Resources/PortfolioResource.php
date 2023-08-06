<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Portfolio;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PortfolioResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PortfolioResource\RelationManagers;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                ->default(auth()->user()->id),

                TextInput::make('label')
                ->required()
                ->maxLength(255),

                TextInput::make('tooltip')
                ->hint('This is the text that will appear when a user hovers over the portfolio item.'),

                RichEditor::make('description')
                ->columnSpan('full')
                ->fileAttachmentsDisk('public')
                ->fileAttachmentsDirectory('attachments'),

                TextInput::make('icon')
                ->hint('Heroicon or SVG, PNG url.'),

                TextInput::make('url')
                ->required()
                ->url()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                ->label("Name")
                ->description(fn (Portfolio $pf) : string=> $pf->tooltip)
                ->searchable(),

                TextColumn::make('url')
                ->url(fn (Portfolio $pf) : string => $pf->url)
                ->openUrlInNewTab(),

                TextColumn::make('created_at')
                ->label("Date")
                ->dateTime(),

                ToggleColumn::make('status')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('delete')
                ->action(fn ($record) => $record->delete())
                ->requiresConfirmation()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
