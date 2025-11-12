<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplicationResource\Pages;
use App\Filament\Resources\JobApplicationResource\RelationManagers;
use App\Models\JobApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Candidaturas';

    protected static ?string $modelLabel = 'Candidatura';

    protected static ?string $pluralModelLabel = 'Candidaturas';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Relacionamentos')
                    ->columns(2)
                    ->schema([
                        Select::make('job_id')
                            ->label('Vaga')
                            ->relationship('job', 'title')
                            ->searchable()
                            ->required(),
                        Select::make('professional_profile_id')
                            ->label('Profissional')
                            ->relationship('professionalProfile', 'first_name', modifyQueryUsing: fn (Builder $query) => $query->with('user'))
                            ->searchable(['first_name', 'last_name'])
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record?->full_name ?? $record?->first_name)
                            ->required(),
                    ]),

                Section::make('Detalhes da Candidatura')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pendente',
                                'viewed' => 'Visualizada',
                                'approved' => 'Aprovada',
                                'rejected' => 'Rejeitada',
                                'withdrawn' => 'Cancelada pelo candidato',
                            ])
                            ->required(),
                        DatePicker::make('viewed_at')
                            ->label('Visualizada em')
                            ->native(false),
                        DatePicker::make('responded_at')
                            ->label('Respondida em')
                            ->native(false),
                    ]),

                Section::make('Conteúdo')
                    ->schema([
                        Textarea::make('cover_letter')
                            ->label('Carta de apresentação')
                            ->rows(6),
                        FileUpload::make('resume_file')
                            ->label('Currículo (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('applications/resumes')
                            ->visibility('public'),
                        Textarea::make('response_message')
                            ->label('Mensagem de resposta')
                            ->rows(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('job.title')
                    ->label('Vaga')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                TextColumn::make('professionalProfile.full_name')
                    ->label('Profissional')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state, JobApplication $record) => $record->professionalProfile?->full_name ?? '—'),
                TextColumn::make('job.companyProfile.company_name')
                    ->label('Empresa')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'viewed',
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'gray' => 'withdrawn',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'viewed' => 'Visualizada',
                        'approved' => 'Aprovada',
                        'rejected' => 'Rejeitada',
                        'withdrawn' => 'Cancelada',
                        default => ucfirst($state),
                    }),
                IconColumn::make('resume_file')
                    ->label('Currículo')
                    ->boolean()
                    ->trueIcon('heroicon-o-document'),
                TextColumn::make('created_at')
                    ->label('Enviada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('viewed_at')
                    ->label('Visualizada em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('responded_at')
                    ->label('Respondida em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pendente',
                        'viewed' => 'Visualizada',
                        'approved' => 'Aprovada',
                        'rejected' => 'Rejeitada',
                        'withdrawn' => 'Cancelada',
                    ]),
                SelectFilter::make('job_id')
                    ->label('Vaga')
                    ->relationship('job', 'title'),
                SelectFilter::make('professional_profile_id')
                    ->label('Profissional')
                    ->relationship('professionalProfile', 'first_name'),
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detalhes')
                    ->icon('heroicon-o-eye'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('markViewed')
                    ->label('Marcar como visualizada')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->visible(fn (JobApplication $record) => $record->status === 'pending')
                    ->action(fn (JobApplication $record) => $record->update([
                        'status' => 'viewed',
                        'viewed_at' => now(),
                    ])),
                Tables\Actions\Action::make('approve')
                    ->label('Aprovar')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (JobApplication $record) => ! in_array($record->status, ['approved', 'withdrawn'], true))
                    ->action(fn (JobApplication $record) => $record->respond('approved')),
                Tables\Actions\Action::make('reject')
                    ->label('Rejeitar')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (JobApplication $record) => ! in_array($record->status, ['rejected', 'withdrawn'], true))
                    ->action(fn (JobApplication $record) => $record->respond('rejected')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListJobApplications::route('/'),
            'create' => Pages\CreateJobApplication::route('/create'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
