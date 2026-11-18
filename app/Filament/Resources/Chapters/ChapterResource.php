<?php

namespace App\Filament\Resources\Chapters;

use App\Filament\Resources\Chapters\Pages\CreateChapter;
use App\Filament\Resources\Chapters\Pages\EditChapter;
use App\Filament\Resources\Chapters\Pages\ListChapters;
use App\Filament\Resources\Chapters\Schemas\ChapterForm;
use App\Filament\Resources\Chapters\Tables\ChaptersTable;
use App\Models\Chapter;
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

class ChapterResource extends Resource
{
    protected static ?string $model = Chapter::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Utility';
    protected static ?string $recordTitleAttribute = 'Chapter';

    public static function form(Schema $schema): Schema
    {
        // return ChapterForm::configure($schema);
        return $schema->schema([
            Section::make('Chapter Profile')
                ->extraAttributes([
                    'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                ])
                ->schema([
                    TextInput::make('chaptername')->required()->maxLength(50),
                    TextInput::make('addressid')->numeric(),
                    Select::make('areaid')->relationship('area', 'areaname')->searchable()->preload()->label('Area'),
                    Select::make('councilid')->relationship('council', 'councilname')->searchable()->preload()->label('Council'),
                    Select::make('catid')->relationship('category', 'name')->searchable()->preload()->label('Category'),
                    Toggle::make('status')->default(true)->required(),
                ])->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        // return ChaptersTable::configure($table);
        return $table
            ->extraAttributes([
                'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
            ])
            ->recordUrl(null)
            ->columns([
                // TextColumn::make('chapid')->sortable(),
                TextColumn::make('chaptername')->searchable()->sortable(),
                TextColumn::make('area.areaname')->label('Area'),
                TextColumn::make('council.councilname')->label('Council'),
                TextColumn::make('category.name')->label('Category'),
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
            'index' => ListChapters::route('/'),
            // 'create' => CreateChapter::route('/create'),
            // 'edit' => EditChapter::route('/{record}/edit'),
        ];
    }
}
