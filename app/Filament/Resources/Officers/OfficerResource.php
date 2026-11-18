<?php

namespace App\Filament\Resources\Officers;

use App\Filament\Resources\Officers\Pages\CreateOfficer;
use App\Filament\Resources\Officers\Pages\EditOfficer;
use App\Filament\Resources\Officers\Pages\ListOfficers;
use App\Filament\Resources\Officers\Schemas\OfficerForm;
use App\Filament\Resources\Officers\Tables\OfficersTable;
use App\Models\Officer;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class OfficerResource extends Resource
{
    protected static ?string $model = Officer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'User Management';
    protected static ?string $recordTitleAttribute = 'Officer';

    public static function form(Schema $schema): Schema
    {
        // return OfficerForm::configure($schema);
        return $schema->schema([
            Section::make('Officer Assignment')
                ->extraAttributes([
                    'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                ])->schema([
                    Select::make('memberid')
                        ->relationship('member', 'lastname')
                        ->getOptionLabelFromRecordUsing(fn($record) => "{$record->lastname}, {$record->firstname}")
                        ->searchable()
                        ->preload()
                        ->required()
                        ->label('Member'),
                    Select::make('rankid')->relationship('rank', 'rankname')->required()->searchable()->preload()->label('Rank'),
                    Select::make('chapid')->relationship('chapter', 'chaptername')->searchable()->preload()->label('Chapter'),
                    Select::make('areaid')->relationship('area', 'areaname')->searchable()->preload()->label('Area'),
                    Select::make('councilid')->relationship('council', 'councilname')->searchable()->preload()->label('Council'),
                    Toggle::make('status')->default(true)->required(),
                ])->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        // return OfficersTable::configure($table);
        return $table
            ->recordUrl(null)
            ->extraAttributes([
                'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
            ])
            ->columns([
                // TextColumn::make('officerid')->sortable(),
                TextColumn::make('member.lastname')->label('Last Name')->searchable(),
                TextColumn::make('member.firstname')->label('First Name'),
                TextColumn::make('rank.rankname')->label('Rank')->sortable(),
                TextColumn::make('chapter.chaptername')->label('Chapter'),
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
            'index' => ListOfficers::route('/'),
            // 'create' => CreateOfficer::route('/create'),
            // 'edit' => EditOfficer::route('/{record}/edit'),
        ];
    }
}
