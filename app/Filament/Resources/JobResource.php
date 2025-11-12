<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Support\Str;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Vagas';

    protected static ?string $modelLabel = 'Vaga';

    protected static ?string $pluralModelLabel = 'Vagas';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações da Vaga')
                    ->columns(3)
                    ->schema([
                        Select::make('company_profile_id')
                            ->label('Empresa')
                            ->relationship('companyProfile', 'company_name')
                            ->searchable()
                            ->required(),
                        TextInput::make('title')
                            ->label('Título da Vaga')
                            ->required()
                            ->maxLength(255)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Rascunho',
                                'active' => 'Publicado',
                                'paused' => 'Pausado',
                                'closed' => 'Encerrado',
                            ])
                            ->required(),
                        Select::make('contract_type')
                            ->label('Tipo de contrato')
                            ->options([
                                'clt' => 'CLT',
                                'pj' => 'PJ',
                                'freelance' => 'Freelancer',
                                'internship' => 'Estágio',
                                'temporary' => 'Temporário',
                            ])
                            ->required(),
                        Select::make('experience_level')
                            ->label('Nível de experiência')
                            ->options([
                                'junior' => 'Júnior',
                                'pleno' => 'Pleno',
                                'senior' => 'Sênior',
                                'lead' => 'Líder',
                                'any' => 'Indiferente',
                            ])
                            ->required(),
                        TextInput::make('work_hours')
                            ->label('Carga horária (horas/semana)')
                            ->numeric()
                            ->minValue(0),
                        TextInput::make('area')
                            ->label('Área de atuação')
                            ->placeholder('Ex.: Banho e tosa, Recepção')
                            ->maxLength(255),
                        Toggle::make('is_featured')
                            ->label('Destacar vaga?')
                            ->default(false),
                        Toggle::make('is_urgent')
                            ->label('Marcar como urgente?')
                            ->default(false),
                        DatePicker::make('deadline')
                            ->label('Data limite')
                            ->native(false),
                        DatePicker::make('published_at')
                            ->label('Publicado em')
                            ->native(false),
                    ]),

                Section::make('Descrição')
                    ->columnSpanFull()
                    ->schema([
                        RichEditor::make('description')
                            ->label('Descrição da vaga')
                            ->required()
                            ->columnSpanFull(),
                        RichEditor::make('requirements')
                            ->label('Requisitos')
                            ->columnSpanFull(),
                        RichEditor::make('benefits')
                            ->label('Benefícios')
                            ->columnSpanFull(),
                    ]),

                Section::make('Remuneração')
                    ->columns(3)
                    ->schema([
                        Select::make('salary_type')
                            ->label('Tipo de salário')
                            ->options([
                                'negotiable' => 'Negociável',
                                'fixed' => 'Valor fixo',
                                'range' => 'Faixa salarial',
                            ])
                            ->required(),
                        TextInput::make('salary_min')
                            ->label('Salário mínimo')
                            ->numeric()
                            ->prefix('R$')
                            ->minValue(0),
                        TextInput::make('salary_max')
                            ->label('Salário máximo')
                            ->numeric()
                            ->prefix('R$')
                            ->minValue(0),
                        TextInput::make('currency')
                            ->label('Moeda')
                            ->maxLength(3)
                            ->default('BRL')
                            ->required(),
                    ]),

                Section::make('Localização')
                    ->columns(3)
                    ->schema([
                        Toggle::make('is_remote')
                            ->label('Vaga remota?')
                            ->inline(false)
                            ->default(false),
                        Toggle::make('is_hybrid')
                            ->label('Vaga híbrida?')
                            ->inline(false)
                            ->default(false),
                        TextInput::make('work_location')
                            ->label('Local de trabalho')
                            ->placeholder('Ex.: Unidade Moema')
                            ->maxLength(255),
                        TextInput::make('city')
                            ->label('Cidade')
                            ->maxLength(100),
                        TextInput::make('state')
                            ->label('Estado (UF)')
                            ->maxLength(2)
                            ->extraInputAttributes(['style' => 'text-transform: uppercase;']),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                TextColumn::make('companyProfile.company_name')
                    ->label('Empresa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'active',
                        'warning' => 'paused',
                        'danger' => 'closed',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Rascunho',
                        'active' => 'Publicado',
                        'paused' => 'Pausado',
                        'closed' => 'Encerrado',
                        default => ucfirst($state),
                    }),
                TextColumn::make('contract_type')
                    ->label('Contrato')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'clt' => 'CLT',
                        'pj' => 'PJ',
                        'freelance' => 'Freelancer',
                        'internship' => 'Estágio',
                        'temporary' => 'Temporário',
                        default => strtoupper($state),
                    }),
                TextColumn::make('experience_level')
                    ->label('Experiência')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'junior' => 'Júnior',
                        'pleno' => 'Pleno',
                        'senior' => 'Sênior',
                        'lead' => 'Líder',
                        'any' => 'Indiferente',
                        default => ucfirst($state),
                    }),
                TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('state')
                    ->label('UF')
                    ->sortable(),
                IconColumn::make('is_remote')
                    ->label('Remota')
                    ->boolean(),
                IconColumn::make('is_hybrid')
                    ->label('Híbrida')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('published_at')
                    ->label('Publicado em')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('deadline')
                    ->label('Limite')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('applications_count')
                    ->label('Candidaturas')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Rascunho',
                        'active' => 'Publicado',
                        'paused' => 'Pausado',
                        'closed' => 'Encerrado',
                    ]),
                SelectFilter::make('contract_type')
                    ->label('Contrato')
                    ->options([
                        'clt' => 'CLT',
                        'pj' => 'PJ',
                        'freelance' => 'Freelancer',
                        'internship' => 'Estágio',
                        'temporary' => 'Temporário',
                    ]),
                SelectFilter::make('experience_level')
                    ->label('Experiência')
                    ->options([
                        'junior' => 'Júnior',
                        'pleno' => 'Pleno',
                        'senior' => 'Sênior',
                        'lead' => 'Líder',
                        'any' => 'Indiferente',
                    ]),
                SelectFilter::make('company_profile_id')
                    ->label('Empresa')
                    ->relationship('companyProfile', 'company_name'),
                TernaryFilter::make('is_remote')
                    ->label('Remota')
                    ->nullable(),
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Ver página')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Job $record) => route('jobs.show', $record->slug))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('publish')
                    ->label('Publicar')
                    ->icon('heroicon-o-megaphone')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Job $record) => in_array($record->status, ['draft', 'paused']))
                    ->action(fn (Job $record) => $record->update([
                        'status' => 'active',
                        'published_at' => now(),
                    ])),
                Tables\Actions\Action::make('pause')
                    ->label('Pausar')
                    ->icon('heroicon-o-pause')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->visible(fn (Job $record) => $record->status === 'active')
                    ->action(fn (Job $record) => $record->update(['status' => 'paused'])),
                Tables\Actions\Action::make('close')
                    ->label('Encerrar')
                    ->icon('heroicon-o-archive-box-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Job $record) => $record->status !== 'closed')
                    ->action(fn (Job $record) => $record->update(['status' => 'closed'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
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
