<?php

namespace App\Filament\Resources;

use App\Enums\QuestionTypeEnum;
use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Filament\Resources\ExamResource\RelationManagers\QuestionRelationManager;
use App\Models\Exam;
use Filament\Forms;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Setting')
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required(),
                        TextArea::make('description')
                            ->label('Description'),
                        TagsInput::make('tags')
                            ->label('Tag')
                            ->separator(','),
                        FileUpload::make('image')
                            ->label('Image')
                            ->image(),
                    ]),
                // ComponentsBuilder::make('questions')
                //     ->blocks([
                //         ComponentsBuilder\Block::make('Multiple Choice')
                //             ->schema([
                //                 TextInput::make('question_type')
                //                     ->default(QuestionTypeEnum::MULTIPLE_CHOICE),
                //                 Textarea::make('question')
                //                     ->required(),
                //                 FileUpload::make('image')
                //                     ->columnSpan(1)
                //                     ->image(),
                //             ])
                //             ->columns(2),
                //         ComponentsBuilder\Block::make('Multiple Answer')
                //             ->schema([
                //                 TextInput::make('question_type')
                //                     ->default(QuestionTypeEnum::MULTIPLE_ANSWER),
                //                 Textarea::make('question')
                //                     ->required(),
                //                 FileUpload::make('image')
                //                     ->columnSpan(1)
                //                     ->image(),
                //             ])
                //             ->columns(2),
                //     ])
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('teacher.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('questions_count')
                    ->counts('questions')
                    ->label('Questions'),
                TextColumn::make('tags')
                    ->badge()
                    ->separator(',')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('questions')
                    ->label('Questions')
                    ->url(fn(Exam $exam) => route('filament.admin.resources.exams.question', $exam)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            QuestionRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
            'question' => Pages\ExamQuestion::route('/{record}/question'),
        ];
    }
}
