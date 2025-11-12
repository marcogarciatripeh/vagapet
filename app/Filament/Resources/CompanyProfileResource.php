<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyProfileResource\Pages;
use App\Filament\Resources\CompanyProfileResource\RelationManagers;
use App\Models\CompanyProfile;
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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

class CompanyProfileResource extends Resource
{
    protected static ?string $model = CompanyProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Empresas';

    protected static ?string $modelLabel = 'Empresa';

    protected static ?string $pluralModelLabel = 'Empresas';

    protected static ?int $navigationSort = 3;

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

                // 1. Dados da Empresa
                Forms\Components\Section::make('Dados da Empresa')
                    ->description('Informações básicas da empresa')
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Nome da Empresa')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('cnpj')
                            ->label('CNPJ')
                            ->mask('99.999.999/9999-99')
                            ->maxLength(18),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel()
                            ->mask('(99) 99999-9999')
                            ->maxLength(20),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->placeholder('www.empresa.com.br')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                // 2. Localização
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

                // 3. Informações da Empresa
                Forms\Components\Section::make('Informações da Empresa')
                    ->description('Descrição, porte e informações profissionais')
                    ->schema([
                        Textarea::make('description')
                            ->label('Descrição')
                            ->placeholder('Fale sobre sua empresa, o que ela tem de diferente, serviços oferecidos (banho, tosa, etc.) e qualquer outro detalhe relevante.')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        Select::make('company_size')
                            ->label('Quantidade de funcionários')
                            ->options([
                                '1-4' => 'Até 4',
                                '5-10' => 'De 5 a 10',
                                '11-20' => 'De 11 a 20',
                                '21+' => 'Acima de 21',
                            ])
                            ->placeholder('Selecione'),

                        TagsInput::make('services')
                            ->label('Serviços oferecidos')
                            ->placeholder('Digite um serviço e pressione enter')
                            ->suggestions([
                                'Banho e tosa',
                                'Creche e hotel',
                                'Veterinária',
                                'Adestramento',
                                'Transporte Pet',
                                'Loja Pet',
                                'Farmácia Pet',
                            ])
                            ->helperText('Use vírgula ou enter para adicionar múltiplos serviços.'),

                        TagsInput::make('specialties')
                            ->label('Especialidades')
                            ->placeholder('Digite uma especialidade e pressione enter')
                            ->suggestions([
                                'Cães de pequeno porte',
                                'Cães de grande porte',
                                'Gatos',
                                'Exóticos',
                                'Reabilitação',
                                'Especialistas em felinos',
                            ])
                            ->helperText('Ajuda os candidatos a entenderem o foco da empresa.'),
                    ])
                    ->columns(2),

                // 4. Arquivos
                Forms\Components\Section::make('Logo e Fotos')
                    ->description('Upload de imagens da empresa')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->helperText('Tamanho máximo: 1MB. Dimensão mínima: 330x300. Formatos: .jpg e .png')
                            ->image()
                            ->imageEditor()
                            ->maxSize(1024)
                            ->directory('companies/logos')
                            ->visibility('public')
                            ->columnSpanFull(),

                        FileUpload::make('photos')
                            ->label('Fotos do Espaço')
                            ->helperText('Tamanho máximo: 2MB por foto. Máximo de 5 fotos. Formatos: .jpg e .png')
                            ->image()
                            ->imageEditor()
                            ->multiple()
                            ->maxFiles(5)
                            ->maxSize(2048)
                            ->directory('companies/photos')
                            ->visibility('public')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                // 5. Redes Sociais
                Forms\Components\Section::make('Redes Sociais')
                    ->description('Inclua suas redes sociais se quiser que outros vejam seu perfil')
                    ->schema([
                        TextInput::make('linkedin')
                            ->label('LinkedIn')
                            ->placeholder('www.linkedin.com/company/empresa')
                            ->url()
                            ->maxLength(255),

                        TextInput::make('instagram')
                            ->label('Instagram')
                            ->placeholder('instagram.com/empresa')
                            ->maxLength(255),

                        TextInput::make('facebook')
                            ->label('Facebook')
                            ->placeholder('www.facebook.com/empresa')
                            ->maxLength(255),

                        TextInput::make('youtube')
                            ->label('YouTube')
                            ->placeholder('www.youtube.com/@empresa')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2)
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

                ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular()
                    ->size(40),

                TextColumn::make('company_name')
                    ->label('Nome da Empresa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->getStateUsing(fn ($record) => $record->user->email)
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Telefone')
                    ->searchable(),

                TextColumn::make('city')
                    ->label('Cidade')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('state')
                    ->label('Estado')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('company_size')
                    ->label('Porte')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'micro' => 'gray',
                        'small' => 'success',
                        'medium' => 'warning',
                        'large' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'micro' => 'Microempresa',
                        'small' => 'Pequena',
                        'medium' => 'Média',
                        'large' => 'Grande',
                        default => 'Não informado',
                    }),

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

                TextColumn::make('jobs_posted_count')
                    ->label('Vagas Publicadas')
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
                        'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas',
                        'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal',
                        'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão',
                        'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais',
                        'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' => 'Pernambuco',
                        'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte',
                        'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima',
                        'SC' => 'Santa Catarina', 'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins',
                    ]),

                SelectFilter::make('company_size')
                    ->label('Porte da Empresa')
                    ->options([
                        'micro' => 'Microempresa',
                        'small' => 'Pequena',
                        'medium' => 'Média',
                        'large' => 'Grande',
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
                    ->url(fn (CompanyProfile $record) => route('companies.show', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Aprovar')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (CompanyProfile $record) => optional($record->user)->is_active === false)
                    ->action(function (CompanyProfile $record) {
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
                    ->visible(fn (CompanyProfile $record) => optional($record->user)->is_active === true)
                    ->action(function (CompanyProfile $record) {
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
            'index' => Pages\ListCompanyProfiles::route('/'),
            'create' => Pages\CreateCompanyProfile::route('/create'),
            'edit' => Pages\EditCompanyProfile::route('/{record}/edit'),
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
