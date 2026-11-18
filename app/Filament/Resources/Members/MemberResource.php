<?php

namespace App\Filament\Resources\Members;

use App\Filament\Resources\Members\Pages\CreateMember;
use App\Filament\Resources\Members\Pages\EditMember;
use App\Filament\Resources\Members\Pages\ListMembers;
use App\Filament\Resources\Members\Schemas\MemberForm;
use App\Filament\Resources\Members\Tables\MembersTable;
use App\Models\Member;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'User Management';
    protected static ?string $recordTitleAttribute = 'Member';

    public static function form(Schema $schema): Schema
    {
        // return MemberForm::configure($schema);
        return $schema
            ->schema([
                Section::make('Personal Information')
                    ->description('Basic identification and personal details of the member.')
                    ->extraAttributes([
                        'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                    ])
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('firstname')
                            ->required()
                            ->maxLength(50),
                        TextInput::make('middlename')
                            ->maxLength(50),
                        TextInput::make('lastname')
                            ->required()
                            ->maxLength(50),
                        Select::make('sex')
                            ->required()
                            ->options([
                                'M' => 'Male',
                                'F' => 'Female',
                            ])
                            ->native(false),
                        DatePicker::make('birthdate')
                            ->required(),
                    ])->columns(2),

                Section::make('Additional Details')
                    ->description('Membership codes, tracking dates, and batch identifiers.')
                    ->extraAttributes([
                        'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                    ])
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('tcode')
                            ->label('T-Code')
                            ->maxLength(20),
                        DatePicker::make('tbirth')
                            ->label('T-Birth Date'),
                        Select::make('t6')
                            ->relationship('chapter', 'chaptername')
                            ->searchable()
                            ->preload()
                            ->label('T-6 (Chapter)'),
                        TextInput::make('talexis')
                            ->label('T-Alexis')
                            ->maxLength(50),
                        TextInput::make('tbatchname')
                            ->label('Batch Name')
                            ->columnSpanFull()
                            ->maxLength(60),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        // return MembersTable::configure($table);
        return $table
            ->extraAttributes([
                'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
            ])
            ->recordUrl(null)
            ->columns([
                // TextColumn::make('memberid')
                //     ->sortable(),
                TextColumn::make('lastname')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('firstname')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('middlename'),
                TextColumn::make('sex')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'M' => 'info',
                        'F' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('birthdate')
                    ->date()
                    ->sortable(),
                TextColumn::make('tcode')
                    ->searchable(),
                TextColumn::make('tbatchname')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
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
                    ->color('danger'),
            ]);
        // ->bulkActions([
        //     BulkActionGroup::make([
        //         DeleteBulkAction::make(),
        //     ]),
        // ]);
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
            'index' => ListMembers::route('/'),
            // 'create' => CreateMember::route('/create'),
            // 'edit' => EditMember::route('/{record}/edit'),
        ];
    }
}
