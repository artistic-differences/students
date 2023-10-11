<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Student Details')
                    ->description('Enter the basic details for the student')
                    ->schema([Forms\Components\TextInput::make('year_group'),

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                        ,
                        Forms\Components\TextInput::make('mobile')
                            ->maxLength(255)])->columns(2),
                Forms\Components\Section::make('Address Details')
                    ->description('Enter the address details for the student')
                    ->schema([ Forms\Components\TextInput::make('address')
                        ->maxLength(255),
                        Forms\Components\TextInput::make('post_code')
                            ->maxLength(255),]),
                Forms\Components\Section::make('Guardian Details')
                    ->description('Enter the details of the student`s guardians')
                ->schema([
                    Forms\Components\TextInput::make('contact1_relationship')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact1_name')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact1_mobile')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact1_email')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact2_relationship')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact2_name')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact2_mobile')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact2_email')
                        ->maxLength(255),
                ])->columns(2),

                Forms\Components\Select::make('subjects')
                    ->label('Subjects')
                    ->multiple()
                    ->relationship('subjects', 'name'),
                Forms\Components\Select::make('classes')
                    ->label('Classes')
                    ->multiple()
                    ->relationship('classes', 'name'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact1_relationship')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact1_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact1_mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact1_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact2_relationship')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact2_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact2_mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact2_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
