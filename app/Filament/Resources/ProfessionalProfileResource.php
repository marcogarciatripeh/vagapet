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

                        Select::make('areas')
                            ->label('Área de trabalho')
                            ->helperText('Você pode incluir mais de uma opção')
                            ->multiple()
                            ->options([
                                'BanhoTosa' => 'Banho & Tosa',
                                'Recepcao' => 'Recepção',
                                'Vendas' => 'Vendas',
                                'Veterinario' => 'Veterinário',
                                'AuxiliarVeterinario' => 'Auxiliar Veterinário',
                                'Limpeza' => 'Limpeza',
                                'Gerente' => 'Gerente',
                                'Estoque' => 'Estoque',
                                'Motorista' => 'Motorista',
                            ])
                            ->searchable(),

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
                Forms\Components\Section::make('Foto de Perfil e Portfólio')
                    ->description('Upload de imagens profissionais')
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

                        Forms\Components\Placeholder::make('portfolio_info')
                            ->label('Portfólio')
                            ->content('Recurso de múltiplas fotos de portfólio será implementado em versão futura.')
                            ->columnSpanFull(),
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

                        TextInput::make('state')
                            ->label('Estado (UF)')
                            ->placeholder('SP')
                            ->maxLength(2)
                            ->extraInputAttributes(['style' => 'text-transform: uppercase;']),

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
