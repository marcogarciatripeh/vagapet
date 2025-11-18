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
use Filament\Forms\Components\TagsInput;
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
                // Usuário (oculto ou select)
                Select::make('user_id')
                    ->label('Usuário')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                // 1. Dados Pessoais
                Forms\Components\Section::make('Dados Pessoais')
                    ->description('Informações básicas do profissional')
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
                            ->mask('(99) 99999-9999')
                            ->maxLength(20),

                        DatePicker::make('birth_date')
                            ->label('Data de Nascimento')
                            ->maxDate(now()->subYears(16))
                            ->displayFormat('d/m/Y'),

                        Select::make('gender')
                            ->label('Gênero')
                            ->options([
                                'male' => 'Masculino',
                                'female' => 'Feminino',
                                'other' => 'Outro',
                            ]),
                    ])
                    ->columns(3),

                // 2. Informações Profissionais
                Forms\Components\Section::make('Informações Profissionais')
                    ->description('Título, experiência e áreas de atuação')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título Profissional')
                            ->placeholder('Ex.: Banhista, tosador, monitor de creche, etc')
                            ->maxLength(255),

                        Select::make('experience_level')
                            ->label('Experiência profissional')
                            ->options([
                                'estagio' => 'Estágio',
                                'junior' => 'Junior (até 2 anos)',
                                'pleno' => 'Pleno (de 3 a 5 anos)',
                                'senior' => 'Sênior (mais de 5 anos)',
                            ]),

                        TextInput::make('years_experience')
                            ->label('Anos de Experiência')
                            ->numeric()
                            ->minValue(0)
                            ->placeholder('Ex.: 5')
                            ->helperText('Total de anos de experiência profissional'),

                        TagsInput::make('areas')
                            ->label('Áreas de atuação')
                            ->placeholder('Informe uma área e pressione enter')
                            ->suggestions([
                                'Banho e tosa',
                                'Creche e hotel',
                                'Adestramento',
                                'Veterinária',
                                'Recepção',
                                'Marketing',
                                'Serviços gerais',
                                'Transporte Pet',
                            ])
                            ->helperText('Use vírgula ou enter para adicionar várias áreas.'),

                        TagsInput::make('skills')
                            ->label('Habilidades')
                            ->placeholder('Informe uma habilidade e pressione enter')
                            ->suggestions([
                                'Atendimento ao cliente',
                                'Tosa na tesoura',
                                'Banho terapêutico',
                                'Primeiros socorros pet',
                                'Gestão de agenda',
                                'Vendas consultivas',
                            ])
                            ->helperText('Ajuda as empresas a encontrarem o profissional ideal.'),

                        Textarea::make('bio')
                            ->label('Descrição')
                            ->placeholder('Fale sobre você, sua experiência, serviços oferecidos (banho, tosa, etc.) e qualquer outro detalhe relevante.')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                // 3. Formação Profissional
                Forms\Components\Section::make('Formação Profissional')
                    ->description('Cursos e formações acadêmicas')
                    ->schema([
                        Repeater::make('education')
                            ->label('Formações')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Nome do Curso')
                                    ->placeholder('Ex.: Curso de Auxiliar Veterinário')
                                    ->required(),
                                TextInput::make('institution')
                                    ->label('Instituição')
                                    ->placeholder('Ex.: Instituto PetCare')
                                    ->required(),
                                TextInput::make('period')
                                    ->label('Período')
                                    ->placeholder('Ex.: 2021 - 2022'),
                                Textarea::make('description')
                                    ->label('Descrição')
                                    ->placeholder('Descreva o conteúdo do curso e aprendizados')
                                    ->rows(2),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->defaultItems(0)
                            ->addActionLabel('Adicionar Formação'),
                    ]),

                // 4. Experiência de Trabalho
                Forms\Components\Section::make('Experiência de Trabalho')
                    ->description('Experiências profissionais anteriores')
                    ->schema([
                        Repeater::make('experiences')
                            ->label('Experiências')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Cargo')
                                    ->placeholder('Ex.: Groomer Sênior')
                                    ->required(),
                                TextInput::make('company')
                                    ->label('Empresa')
                                    ->placeholder('Ex.: Pet4U')
                                    ->required(),
                                TextInput::make('period')
                                    ->label('Período')
                                    ->placeholder('Ex.: 2022 - Atual'),
                                TextInput::make('salary')
                                    ->label('Salário')
                                    ->placeholder('Ex.: R$ 2.500,00')
                                    ->helperText('Salário recebido nesta posição'),
                                Textarea::make('description')
                                    ->label('Descrição')
                                    ->placeholder('Descreva suas responsabilidades e realizações')
                                    ->rows(2),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->defaultItems(0)
                            ->addActionLabel('Adicionar Experiência'),
                    ]),

                // 5. Arquivos
                Forms\Components\Section::make('Foto de Perfil')
                    ->description('Upload de imagem profissional')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto de Perfil')
                            ->helperText('Tamanho máximo: 1MB. Dimensão mínima: 330x300. Formatos: .jpg e .png')
                            ->image()
                            ->imageEditor()
                            ->maxSize(1024)
                            ->directory('professionals/photos')
                            ->visibility('public')
                            ->columnSpanFull(),
                        FileUpload::make('resume')
                            ->label('Currículo (PDF)')
                            ->acceptedFileTypes(['application/pdf'])
                            ->helperText('Envie um PDF de até 2MB.')
                            ->maxSize(2048)
                            ->directory('professionals/resumes')
                            ->visibility('public'),
                    ])
                    ->columns(2),

                // 6. Redes Sociais
                Forms\Components\Section::make('Redes Sociais')
                    ->description('Inclua suas redes sociais se quiser que outros vejam seu perfil')
                    ->schema([
                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->placeholder('www.facebook.com/MeuPerfil')
                            ->maxLength(255),

                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('instagram.com/meuperfil')
                            ->maxLength(255),

                        TextInput::make('linkedin')
                            ->label('LinkedIn')
                            ->placeholder('www.linkedin.com/in/meuperfil')
                            ->maxLength(255),

                        TextInput::make('website')
                            ->label('Site Pessoal')
                            ->placeholder('www.meuservicos.com.br')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsed(),

                // 7. Localização
                Forms\Components\Section::make('Localização')
                    ->description('Endereço e localização no mapa')
                    ->schema([
                        Textarea::make('address')
                            ->label('Endereço Completo (não será divulgado)')
                            ->placeholder('Rua Exemplo, 123')
                            ->helperText('Este endereço não ficará público, é apenas para referência')
                            ->rows(2)
                            ->maxLength(500)
                            ->columnSpanFull(),

                        TextInput::make('neighborhood')
                            ->label('Bairro')
                            ->placeholder('Vila Clementina')
                            ->maxLength(255),

                        TextInput::make('city')
                            ->label('Cidade')
                            ->placeholder('São Paulo')
                            ->helperText('Bairro e cidade ficarão visíveis na plataforma')
                            ->required()
                            ->maxLength(100),

                        Select::make('state')
                            ->label('Estado (UF)')
                            ->options(\App\Helpers\BrazilianStates::getStates())
                            ->searchable()
                            ->placeholder('Selecione o estado'),

                        TextInput::make('zip_code')
                            ->label('CEP')
                            ->mask('99999-999')
                            ->maxLength(10),

                        TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->step(0.00000001)
                            ->placeholder('-23.550520'),

                        TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->step(0.00000001)
                            ->placeholder('-46.633308'),
                    ])
                    ->columns(3)
                    ->collapsed(),

                // 8. Configurações de Privacidade
                Forms\Components\Section::make('Configurações de Privacidade')
                    ->description('Controle de visibilidade e privacidade do perfil')
                    ->schema([
                        Forms\Components\Toggle::make('is_public')
                            ->label('Perfil público')
                            ->helperText('Torna o perfil visível publicamente')
                            ->default(true),

                        Forms\Components\Toggle::make('show_in_search')
                            ->label('Aparecer nas buscas')
                            ->helperText('Permite que o perfil apareça nos resultados de busca')
                            ->default(true),

                        Forms\Components\Toggle::make('allow_direct_contact')
                            ->label('Permitir contato direto')
                            ->helperText('Permite que empresas vejam telefone e e-mail')
                            ->default(true),

                        Forms\Components\Toggle::make('show_current_salary')
                            ->label('Mostrar salário das experiências')
                            ->helperText('Exibe os salários informados nas experiências profissionais')
                            ->default(false),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }

    public static function mutateFormDataBeforeFill(array $data): array
    {
        $data['skills'] = collect($data['skills'] ?? [])
            ->map(fn ($skill) => is_array($skill) ? ($skill['skill'] ?? null) : $skill)
            ->filter()
            ->values()
            ->all();

        $data['education'] = collect($data['education'] ?? [])
            ->map(function ($item) {
                if (! is_array($item)) {
                    return [
                        'title' => $item,
                        'institution' => null,
                        'period' => null,
                        'description' => null,
                    ];
                }

                return [
                    'title' => $item['title'] ?? $item['course'] ?? null,
                    'institution' => $item['institution'] ?? null,
                    'period' => $item['period'] ?? null,
                    'description' => $item['description'] ?? null,
                ];
            })
            ->filter(fn ($item) => $item['title'])
            ->values()
            ->all();

        $data['experiences'] = collect($data['experiences'] ?? [])
            ->map(function ($item) {
                if (! is_array($item)) {
                    return [
                        'title' => $item,
                        'company' => null,
                        'period' => null,
                        'salary' => null,
                        'description' => null,
                    ];
                }

                return [
                    'title' => $item['title'] ?? $item['role'] ?? null,
                    'company' => $item['company'] ?? null,
                    'period' => $item['period'] ?? null,
                    'salary' => $item['salary'] ?? null,
                    'description' => $item['description'] ?? null,
                ];
            })
            ->filter(fn ($item) => $item['title'])
            ->values()
            ->all();

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        $data['skills'] = collect($data['skills'] ?? [])
            ->map(fn ($skill) => is_array($skill) ? ($skill['skill'] ?? null) : $skill)
            ->filter()
            ->values()
            ->all();

        $data['education'] = collect($data['education'] ?? [])
            ->map(function ($item) {
                if (! is_array($item)) {
                    return null;
                }

                return array_filter([
                    'title' => $item['title'] ?? $item['course'] ?? null,
                    'institution' => $item['institution'] ?? null,
                    'period' => $item['period'] ?? null,
                    'description' => $item['description'] ?? null,
                ], fn ($value) => filled($value));
            })
            ->filter()
            ->values()
            ->all();

        $data['experiences'] = collect($data['experiences'] ?? [])
            ->map(function ($item) {
                if (! is_array($item)) {
                    return null;
                }

                return array_filter([
                    'title' => $item['title'] ?? $item['role'] ?? null,
                    'company' => $item['company'] ?? null,
                    'period' => $item['period'] ?? null,
                    'salary' => $item['salary'] ?? null,
                    'description' => $item['description'] ?? null,
                ], fn ($value) => filled($value));
            })
            ->filter()
            ->values()
            ->all();

        return $data;
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
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'estagio' => 'Estágio',
                        'junior' => 'Junior',
                        'pleno' => 'Pleno',
                        'senior' => 'Sênior',
                        default => $state ?? 'Não informado',
                    }),

                TextColumn::make('years_experience')
                    ->label('Anos de Experiência')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('neighborhood')
                    ->label('Bairro')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('state')
                    ->label('Estado')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'completed',
                        'danger' => 'inactive',
                    ])
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'pending' => 'Em análise',
                        'completed' => 'Ativo',
                        'inactive' => 'Inativo',
                        default => 'Sem status',
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('views_count')
                    ->label('Visualizações')
                    ->sortable(),

                TextColumn::make('applications_count')
                    ->label('Candidaturas')
                    ->sortable(),

                TextColumn::make('is_public')
                    ->label('Público')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('show_in_search')
                    ->label('Aparece em Buscas')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('allow_direct_contact')
                    ->label('Contato Direto')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('show_current_salary')
                    ->label('Mostra Salário')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

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

                SelectFilter::make('experience_level')
                    ->label('Experiência')
                    ->options([
                        'estagio' => 'Estágio',
                        'junior' => 'Junior',
                        'pleno' => 'Pleno',
                        'senior' => 'Sênior',
                    ]),

                SelectFilter::make('status')
                    ->label('Status da Conta')
                    ->options([
                        'pending' => 'Em análise',
                        'completed' => 'Ativo',
                        'inactive' => 'Inativo',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (! $data['value']) {
                            return $query;
                        }

                        return $query->whereHas('user', fn (Builder $userQuery) => $userQuery->where('status', $data['value']));
                    }),

                SelectFilter::make('is_active')
                    ->label('Perfil Ativo?')
                    ->options([
                        '1' => 'Ativo',
                        '0' => 'Inativo',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if (! isset($data['value'])) {
                            return $query;
                        }

                        return $query->whereHas('user', fn (Builder $userQuery) => $userQuery->where('is_active', (bool) $data['value']));
                    }),

                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Ver página')
                    ->icon('heroicon-o-eye')
                    ->url(fn (ProfessionalProfile $record) => route('professionals.show', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Aprovar')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (ProfessionalProfile $record) => optional($record->user)->is_active === false)
                    ->action(function (ProfessionalProfile $record) {
                        if ($record->user) {
                            $record->user->update([
                                'is_active' => true,
                                'status' => 'completed',
                            ]);
                        }
                    }),
                Tables\Actions\Action::make('deactivate')
                    ->label('Desativar')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (ProfessionalProfile $record) => optional($record->user)->is_active === true)
                    ->action(function (ProfessionalProfile $record) {
                        if ($record->user) {
                            $record->user->update([
                                'is_active' => false,
                                'status' => 'inactive',
                            ]);
                        }
                    }),
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
