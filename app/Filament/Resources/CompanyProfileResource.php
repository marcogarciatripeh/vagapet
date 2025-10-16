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
use Filament\Forms\Components\Repeater;
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
                Forms\Components\Section::make('Dados da Empresa')
                    ->schema([
                        TextInput::make('company_name')
                            ->label('Nome da Empresa')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('cnpj')
                            ->label('CNPJ')
                            ->maxLength(20),

                        TextInput::make('phone')
                            ->label('Telefone')
                            ->tel()
                            ->maxLength(20),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Localização')
                    ->schema([
                        Textarea::make('address')
                            ->label('Endereço')
                            ->rows(2)
                            ->maxLength(500),

                        TextInput::make('city')
                            ->label('Cidade')
                            ->maxLength(100),

                        TextInput::make('state')
                            ->label('Estado')
                            ->maxLength(2),

                        TextInput::make('zip_code')
                            ->label('CEP')
                            ->maxLength(10),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informações da Empresa')
                    ->schema([
                        Textarea::make('description')
                            ->label('Descrição')
                            ->rows(3)
                            ->maxLength(1000),

                        TextInput::make('employees_count')
                            ->label('Número de Funcionários')
                            ->numeric()
                            ->minValue(1),

                        Select::make('company_size')
                            ->label('Porte da Empresa')
                            ->options([
                                'micro' => 'Microempresa',
                                'small' => 'Pequena',
                                'medium' => 'Média',
                                'large' => 'Grande',
                            ]),

                        Repeater::make('services')
                            ->label('Serviços')
                            ->schema([
                                TextInput::make('service')
                                    ->label('Serviço')
                                    ->required(),
                            ])
                            ->simple(TextInput::make('service')),

                        Repeater::make('specialties')
                            ->label('Especialidades')
                            ->schema([
                                TextInput::make('specialty')
                                    ->label('Especialidade')
                                    ->required(),
                            ])
                            ->simple(TextInput::make('specialty')),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Arquivos')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->directory('companies/logos')
                            ->visibility('public'),

                        FileUpload::make('photos')
                            ->label('Fotos')
                            ->image()
                            ->multiple()
                            ->directory('companies/photos')
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

                        TextInput::make('youtube')
                            ->label('YouTube')
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
