<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\Area;
use App\Models\Chapter;
use App\Models\Council;
use App\Models\User;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'User Management';
    
    protected static ?string $recordTitleAttribute = 'User';

    public static function form(Schema $schema): Schema
    {
        // return UserForm::configure($schema);
        return $schema
            ->schema([
                Section::make('User Account Details')
                    ->extraAttributes([
                        'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                    ])
                    ->description('Manage system user login credentials and associated member details.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true),
                        TextInput::make('password')
                            ->password()
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->maxLength(255),
                        Select::make('memberid')
                            ->relationship('member', 'lastname')
                            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->lastname}, {$record->firstname}")
                            ->searchable()
                            ->preload()
                            ->label('Associated Member'),
                        TextInput::make('mobilenumber')
                            ->numeric()
                            ->label('Mobile Number')
                            ->unique(ignoreRecord: true),
                        // 1. Account Type Dropdown (Live to trigger state changes)
                        Select::make('accountType')
                            ->required()
                            ->options([
                                'MEMBER' => 'MEMBER',
                                'CHAPTER' => 'CHAPTER',
                                'AREA' => 'AREA',
                                'COUNCIL' => 'COUNCIL',
                            ])
                            ->native(false)
                            ->live() // Triggers live updates for dependent fields
                            ->afterStateUpdated(fn(callable $set) => $set('typeid', null)), // Reset typeid when type changes
                        // 2. Dynamic Type ID field (Hidden if MEMBER, shown & populated based on selection)
                        Select::make('typeid')
                            ->label(fn(Get $get) => match ($get('accountType')) {
                                'CHAPTER' => 'Select Chapter',
                                'AREA' => 'Select Area',
                                'COUNCIL' => 'Select Council',
                                default => 'Type ID',
                            })
                            ->options(function (Get $get) {
                                // Lookup corresponding table based on accountType selection and capture primary ID
                                return match ($get('accountType')) {
                                    'CHAPTER' => Chapter::pluck('chaptername', 'chapid'),
                                    'AREA' => Area::pluck('areaname', 'areaid'),
                                    'COUNCIL' => Council::pluck('councilname', 'councilid'),
                                    default => [],
                                };
                            })
                            ->searchable()
                            ->preload()
                            ->required(fn(Get $get) => in_array($get('accountType'), ['CHAPTER', 'AREA', 'COUNCIL']))
                            ->visible(fn(Get $get) => in_array($get('accountType'), ['CHAPTER', 'AREA', 'COUNCIL'])), // Hidden by default or when MEMBER is selected
                        Toggle::make('status')
                            ->default(true)
                            ->required(),
                    ])->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        // return UsersTable::configure($table);
        return $table
            ->extraAttributes([
                'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
            ])
            ->recordUrl(null)
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('member.fullname') // Assuming you have a fullname accessor in the Member model
                    ->label('Member')
                    ->sortable(),
                TextColumn::make('accountType')
                    ->badge(),
                TextColumn::make('typeid')
                    ->label('Type ID')
                    ->formatStateUsing(function ($state, $record) {
                        // Dynamically fetch the name based on accountType and typeid
                        return match ($record->accountType) {
                            'CHAPTER' => optional(Chapter::find($state))->chaptername,
                            'AREA' => optional(Area::find($state))->areaname,
                            'COUNCIL' => optional(Council::find($state))->councilname,
                            default => $state,
                        };
                    }),
                TextColumn::make('mobilenumber')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('status')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
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
            'index' => ListUsers::route('/'),
            // 'create' => CreateUser::route('/create'),
            // 'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
