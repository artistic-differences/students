<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherClassResource\Pages;
use App\Filament\Resources\TeacherClassResource\RelationManagers;
use App\Models\Subject;
use App\Models\TeacherClass;
use App\Models\User;
use App\Models\YearGroup;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherClassResource extends Resource
{
    protected static ?string $model = TeacherClass::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('teacher_id')
                    ->label('Teacher')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('subject_id')
                    ->label('Subject')
                    ->options(Subject::all()->pluck('name', 'id'))
                    ->searchable()
                    ->reactive()
                    ->required(),
                Forms\Components\Select::make('year_group_id')
                    ->label('Year Group')
                    ->options(YearGroup::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive(),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(12),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                Forms\Components\CheckboxList::make('students')
                    ->label('Unassigned Students')
                    ->relationship(
                        name: 'students',
                        titleAttribute:'name',modifyQueryUsing: function (Builder $query, callable $get) {
                            $query
                                ->join('student_subjects', 'student_subjects.student_id', '=', 'students.id')
                                ->where('year_group_id', '=', $get('year_group_id'))
                                ->where('subject_id', '=', $get('subject_id'))
                                ->where('student_classes.created_at', '=', null)
                            ;
                        }
                    )
                    ->columns(3),
                Forms\Components\CheckboxList::make('students')
                    ->label('Assigned Students')
                    ->relationship(
                        name: 'students',
                        titleAttribute:'name',modifyQueryUsing: function (Builder $query, callable $get) {
                        $query
                            ->join('student_subjects', 'student_subjects.student_id', '=', 'students.id')
                            ->where('year_group_id', '=', $get('year_group_id'))
                            ->where('subject_id', '=', $get('subject_id'))
                            ->where('student_classes.created_at', '<>', null)
                        ;
                    }
                    )
                    ->columns(3),
                    Repeater::make('teaching_blocks')
                        ->relationship(modifyQueryUsing: fn (Builder $query, callable $get) =>
                        $query->orderBy('day_of_week', 'asc')->orderBy('block_start','asc'))


                        ->schema([
                            Select::make('day_of_week')
                                ->options([
                                    '1' => 'Monday',
                                    '2' => 'Tuesday',
                                    '3' => 'Wednesday',
                                    '4' => 'Thursday',
                                    '5' => 'Friday',
                                ])
                                ->required(),
                            Select::make('block_start')
                                ->options([
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                ])
                                ->required(),
                            Select::make('block_end')
                                ->options([
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                ])
                                ->required(),
                        ])
                        ->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('teacher.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
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
            'index' => Pages\ListTeacherClasses::route('/'),
            'create' => Pages\CreateTeacherClass::route('/create'),
            'edit' => Pages\EditTeacherClass::route('/{record}/edit'),
        ];
    }
}
