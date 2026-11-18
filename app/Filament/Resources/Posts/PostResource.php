<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Utility';
    protected static ?string $recordTitleAttribute = 'Post';

    public static function form(Schema $schema): Schema
    {
        // return PostForm::configure($schema);
        return $schema
            ->schema([
                Section::make('Post Details')
                    ->extraAttributes([
                        'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
                    ])
                    ->description('Create and manage community posts and articles.')
                    ->schema([
                        TextInput::make('postname')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Hidden::make('status')
                            ->default(true)
                            ->required(),
                        Textarea::make('postdetails')
                            ->columnSpanFull(),
                        // Multiple Image Upload Component
                        FileUpload::make('postphotos')
                            ->label('Post Photos')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->panelLayout('grid')
                            ->directory('posts-photos')
                            ->columnSpanFull(),
                    ])->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        // return PostsTable::configure($table);
        return $table
            ->recordUrl(null)
            ->extraAttributes([
                'style' => 'border: 2px solid var(--gray-500) !important; border-radius: 0.75rem;',
            ])
            ->columns([
                TextColumn::make('postid')->sortable(),
                TextColumn::make('postname')->searchable()->sortable(),
                IconColumn::make('status')->boolean(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
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
            'index' => ListPosts::route('/'),
            // 'create' => CreatePost::route('/create'),
            // 'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
