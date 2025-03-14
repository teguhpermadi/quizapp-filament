<?php

namespace App\Filament\Resources\ExamResource\RelationManagers;

use App\Enums\QuestionTypeEnum;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuestionRelationManager extends RelationManager
{
    protected static string $relationship = 'question';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Textarea::make('question')
                //     ->required(),
                FileUpload::make('image')
                    ->columnSpan(1)
                    ->image(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            // ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('question')
                    ->wrap(),
                TextColumn::make('question_type')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->slideOver(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
