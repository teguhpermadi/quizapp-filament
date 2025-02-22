<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Filament\Resources\GradeResource\RelationManagers;
use App\Filament\Resources\GradeResource\RelationManagers\StudentsRelationManager;
use App\Filament\Resources\GradeResource\RelationManagers\SubjectsRelationManager;
use App\Models\Grade;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                // count relation
                TextColumn::make('students_count')
                    ->label('Students Count')
                    ->sortable()
                    ->counts('students'),
                // count relation
                TextColumn::make('teachers_count')
                    ->label('Teachers Count')
                    ->sortable()
                    ->counts('teachers'),
                // count relation
                TextColumn::make('subjects_count')
                    ->label('Subjects Count')
                    ->sortable()
                    ->counts('subjects'),
            ])
            ->filters([
                //
            ])
            ->actions([
                RelationManagerAction::make('student-relation-manager')
                    ->label('Students')
                    ->relationManager(StudentsRelationManager::make()),
                RelationManagerAction::make('subject-relation-manager')
                    ->label('Subjects')
                    ->relationManager(SubjectsRelationManager::make()),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $teacherRole = auth()->user()->hasRole('teacher');

                if ($teacherRole) {
                    $query->myGrades();
                }
            });
    }

    public static function getRelations(): array
    {
        return [
            StudentsRelationManager::class,
            SubjectsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}
