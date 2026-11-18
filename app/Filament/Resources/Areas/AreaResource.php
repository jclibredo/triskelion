<?php

namespace App\Filament\Resources\Areas;

use App\Filament\Resources\Areas\Pages\ListAreas;
use App\Models\Area;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
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

class AreaResource extends Resource
{
    protected static ?string $model = Area::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Utility';
    protected static ?string $recordTitleAttribute = 'Area';

    public static function form(Schema $schema): Schema
    {
        // return AreaForm::configure($schema);
        return $schema->schema([
            Section::make('Area Information')
                ->extraAttributes([
                    'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                ])->schema([
                    TextInput::make('areaname')->required()->maxLength(50),
                    Select::make('councilid')
                        ->relationship('council', 'councilname')
                        ->searchable()
                        ->preload()
                        ->label('Council'),
                    Toggle::make('status')->default(true)->required(),
                    Textarea::make('address')->maxLength(1000)->columnSpanFull(),
                ])->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        // return AreasTable::configure($table);
        return $table
            ->extraAttributes([
                'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
            ])
            ->recordUrl(null)
            ->columns([
                // TextColumn::make('areaid')->sortable(),
                TextColumn::make('areaname')->searchable()->sortable(),
                TextColumn::make('address')->limit(50),
                TextColumn::make('council.councilname')->label('Council')->sortable(),
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
            'index' => ListAreas::route('/'),
            // 'create' => CreateArea::route('/create'),
            // 'edit' => EditArea::route('/{record}/edit'),
        ];
    }
}
