<?php

namespace App\Filament\Resources\Councils;

use App\Filament\Resources\Councils\Pages\CreateCouncil;
use App\Filament\Resources\Councils\Pages\EditCouncil;
use App\Filament\Resources\Councils\Pages\ListCouncils;
use App\Filament\Resources\Councils\Schemas\CouncilForm;
use App\Filament\Resources\Councils\Tables\CouncilsTable;
use App\Models\Council;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
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

class CouncilResource extends Resource
{
    protected static ?string $model = Council::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Utility';
    protected static ?string $recordTitleAttribute = 'Council';

    public static function form(Schema $schema): Schema
    {
        // return CouncilForm::configure($schema);
        return $schema->schema([
            Section::make('Council Information')
                ->extraAttributes([
                    'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                ])
                ->schema([
                    TextInput::make('councilname')->required()->maxLength(50),
                    Select::make('catid')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->label('Category'),
                    TextInput::make('counciladdress')->maxLength(50),
                    Toggle::make('status')->default(true)->required(),
                ])->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        // return CouncilsTable::configure($table);
        return $table
            ->recordUrl(null)
            ->extraAttributes([
                'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
            ])
            ->columns([
                // TextColumn::make('councilid')->sortable(),
                TextColumn::make('councilname')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('counciladdress'),
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
            'index' => ListCouncils::route('/'),
            // 'create' => CreateCouncil::route('/create'),
            // 'edit' => EditCouncil::route('/{record}/edit'),
        ];
    }
}
