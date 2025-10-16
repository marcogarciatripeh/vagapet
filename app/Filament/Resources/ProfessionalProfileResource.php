<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalProfileResource\Pages;
use App\Filament\Resources\ProfessionalProfileResource\RelationManagers;
use App\Models\ProfessionalProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

class ProfessionalProfileResource extends Resource
{
    protected static ?string $model = ProfessionalProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Profissionais';

    protected static ?string $modelLabel = 'Profissional';

    protected static ?string $pluralModelLabel = 'Profissionais';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Dados Pessoais')
                    ->schema([
                        TextInput::make('first_name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('last_name')
                            ->label('Sobrenome')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel()
                            ->maxLength(20),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Localização')
                    ->schema([
                        Textarea::make('address')
                            ->label('Endereço Completo')
                            ->rows(2)
                            ->maxLength(500),

                        TextInput::make('city')
                            ->label('Cidade')
                            ->maxLength(100),

                        TextInput::make('state')
                            ->label('Estado')
                            ->maxLength(2),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informações Profissionais')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título Profissional')
                            ->maxLength(255),

                        Select::make('experience_level')
                            ->label('Nível de Experiência')
                            ->options([
                                'estagio' => 'Estágio',
                                'junior' => 'Junior (até 2 anos)',
                                'pleno' => 'Pleno (de 3 a 5 anos)',
                                'senior' => 'Sênior (mais de 5 anos)',
                            ]),

                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3)
                            ->maxLength(1000),

                        Repeater::make('areas')
                            ->label('Áreas de Trabalho')
                            ->simple(TextInput::make('area')
                                ->label('Área')
                                ->required()),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Formação')
                    ->schema([
                        Repeater::make('education')
                            ->label('Formações')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Nome do Curso')
                                    ->required(),
                                TextInput::make('institution')
                                    ->label('Instituição')
                                    ->required(),
                                TextInput::make('period')
                                    ->label('Período'),
                                Textarea::make('description')
                                    ->label('Descrição')
                                    ->rows(2),
                            ])
                            ->columns(2),
                    ]),

                Forms\Components\Section::make('Experiência Profissional')
                    ->schema([
                        Repeater::make('experiences')
                            ->label('Experiências')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Cargo')
                                    ->required(),
                                TextInput::make('company')
                                    ->label('Empresa')
                                    ->required(),
                                TextInput::make('period')
                                    ->label('Período'),
                                Textarea::make('description')
                                    ->label('Descrição')
                                    ->rows(2),
                            ])
                            ->columns(2),
                    ]),

                Forms\Components\Section::make('Arquivos')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto de Perfil')
                            ->image()
                            ->directory('professionals/photos')
                            ->visibility('public'),

                        FileUpload::make('resume')
                            ->label('Currículo')
                            ->acceptedFileTypes(['application/pdf'])
                            ->directory('professionals/resumes')
                            ->visibility('public'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Redes Sociais')
                    ->schema([
                        TextInput::make('linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->maxLength(255),

                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->maxLength(255),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->size(40),

                TextColumn::make('first_name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('last_name')
                    ->label('Sobrenome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->getStateUsing(fn ($record) => $record->user->email)
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),

                TextColumn::make('title')
                    ->label('Título Profissional')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('experience_level')
                    ->label('Experiência')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'estagio' => 'Estágio',
                        'junior' => 'Junior',
                        'pleno' => 'Pleno',
                        'senior' => 'Sênior',
                        default => $state,
                    }),

                TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('state')
                    ->label('Estado')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('views_count')
                    ->label('Visualizações')
                    ->sortable(),

                TextColumn::make('applications_count')
                    ->label('Candidaturas')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->label('Estado')
                    ->options([
                        'AC' => 'Acre',
                        'AL' => 'Alagoas',
                        'AP' => 'Amapá',
                        'AM' => 'Amazonas',
                        'BA' => 'Bahia',
                        'CE' => 'Ceará',
                        'DF' => 'Distrito Federal',
                        'ES' => 'Espírito Santo',
                        'GO' => 'Goiás',
                        'MA' => 'Maranhão',
                        'MT' => 'Mato Grosso',
                        'MS' => 'Mato Grosso do Sul',
                        'MG' => 'Minas Gerais',
                        'PA' => 'Pará',
                        'PB' => 'Paraíba',
                        'PR' => 'Paraná',
                        'PE' => 'Pernambuco',
                        'PI' => 'Piauí',
                        'RJ' => 'Rio de Janeiro',
                        'RN' => 'Rio Grande do Norte',
                        'RS' => 'Rio Grande do Sul',
                        'RO' => 'Rondônia',
                        'RR' => 'Roraima',
                        'SC' => 'Santa Catarina',
                        'SP' => 'São Paulo',
                        'SE' => 'Sergipe',
                        'TO' => 'Tocantins',
                    ]),

                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
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
            'index' => Pages\ListProfessionalProfiles::route('/'),
            'create' => Pages\CreateProfessionalProfile::route('/create'),
            'edit' => Pages\EditProfessionalProfile::route('/{record}/edit'),
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
