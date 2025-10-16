<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'account' => 'Conta & Acesso',
            'jobs' => 'Vagas & Candidaturas',
            'company' => 'Empresas',
            'professional' => 'Profissionais',
            'payment' => 'Pagamentos',
            'technical' => 'Suporte Técnico',
            'general' => 'Geral',
            default => 'Outro',
        };
    }
}
