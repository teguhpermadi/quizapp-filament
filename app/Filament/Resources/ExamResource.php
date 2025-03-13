<?php

namespace App\Filament\Resources;

use App\Enums\QuestionTypeEnum;
use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\RelationManagers;
use App\Models\Exam;
use Filament\Forms;
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
                TextColumn::make('question_count')
                    ->counts('question')
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
                Action::make('question')
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
            //
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
