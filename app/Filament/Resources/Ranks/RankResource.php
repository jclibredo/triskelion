<?php

namespace App\Filament\Resources\Ranks;

use App\Filament\Resources\Ranks\Pages\CreateRank;
use App\Filament\Resources\Ranks\Pages\EditRank;
use App\Filament\Resources\Ranks\Pages\ListRanks;
use App\Filament\Resources\Ranks\Schemas\RankForm;
use App\Filament\Resources\Ranks\Tables\RanksTable;
use App\Models\Rank;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class RankResource extends Resource
{
    protected static ?string $model = Rank::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Utility';
    protected static ?string $recordTitleAttribute = 'Rank';

    public static function form(Schema $schema): Schema
    {
        // return RankForm::configure($schema);
        return $schema->schema([
            Section::make('Rank Details')
                ->extraAttributes([
                    'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                ])
                ->schema([
                    TextInput::make('rankname')->required()->maxLength(100),
                    Toggle::make('status')->default(true)->required(),
                    Textarea::make('rankdetails')->maxLength(500)->columnSpanFull(),
                ])->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        // return RanksTable::configure($table);
        return $table
            ->extraAttributes([
                'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
            ])
            ->recordUrl(null)
            ->columns([
                // TextColumn::make('rankid')->sortable(),
                TextColumn::make('rankname')->searchable()->sortable(),
                IconColumn::make('status')->boolean(),
            ])->actions([ActionGroup::make([
                EditAction::make()
                    ->label('Update'),
                DeleteAction::make()
                    ->label('Remove'),
            ])
                ->label('Action')
                ->icon('heroicon-m-chevron-down')
                ->button()
                ->size('xs')
                ->outlined()
                ->color('danger'),]);
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
            'index' => ListRanks::route('/'),
            // 'create' => CreateRank::route('/create'),
            // 'edit' => EditRank::route('/{record}/edit'),
        ];
    }
}
