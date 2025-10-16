<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'FAQ';

    protected static ?string $modelLabel = 'Pergunta Frequente';

    protected static ?string $pluralModelLabel = 'Perguntas Frequentes';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações da Pergunta')
                    ->schema([
                        TextInput::make('question')
                            ->label('Pergunta')
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),

                        Textarea::make('answer')
                            ->label('Resposta')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),

                        Select::make('category')
                            ->label('Categoria')
                            ->options([
                                'account' => 'Conta & Acesso',
                                'jobs' => 'Vagas & Candidaturas',
                                'company' => 'Empresas',
                                'professional' => 'Profissionais',
                                'payment' => 'Pagamentos',
                                'technical' => 'Suporte Técnico',
                                'general' => 'Geral',
                            ])
                            ->required()
                            ->default('general'),

                        TextInput::make('sort_order')
                            ->label('Ordem')
                            ->numeric()
                            ->default(0)
                            ->helperText('Usado para ordenar as perguntas'),

                        Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true)
                            ->helperText('Perguntas inativas não serão exibidas no site'),
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

                TextColumn::make('question')
                    ->label('Pergunta')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('answer')
                    ->label('Resposta')
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),

                TextColumn::make('category')
                    ->label('Categoria')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'account' => 'info',
                        'jobs' => 'success',
                        'company' => 'warning',
                        'professional' => 'primary',
                        'payment' => 'danger',
                        'technical' => 'secondary',
                        'general' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'account' => 'Conta & Acesso',
                        'jobs' => 'Vagas & Candidaturas',
                        'company' => 'Empresas',
                        'professional' => 'Profissionais',
                        'payment' => 'Pagamentos',
                        'technical' => 'Suporte Técnico',
                        'general' => 'Geral',
                        default => 'Outro',
                    }),

                TextColumn::make('sort_order')
                    ->label('Ordem')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Categoria')
                    ->options([
                        'account' => 'Conta & Acesso',
                        'jobs' => 'Vagas & Candidaturas',
                        'company' => 'Empresas',
                        'professional' => 'Profissionais',
                        'payment' => 'Pagamentos',
                        'technical' => 'Suporte Técnico',
                        'general' => 'Geral',
                    ]),

                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Ativo',
                        0 => 'Inativo',
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
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
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
