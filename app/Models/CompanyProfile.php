<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'company_name', 'cnpj', 'phone', 'website', 'description',
        'address', 'neighborhood', 'city', 'state', 'zip_code', 'latitude', 'longitude',
        'services', 'specialties', 'employees_count', 'company_size',
        'logo', 'photos', 'linkedin', 'instagram', 'facebook', 'youtube',
        'views_count', 'jobs_posted_count', 'applications_received_count'
    ];

    protected $casts = [
        'services' => 'array',
        'specialties' => 'array',
        'photos' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'views_count' => 'integer',
        'jobs_posted_count' => 'integer',
        'applications_received_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function scopeActive($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('is_active', true);
        });
    }

    public function getLocationAttribute(): string
    {
        $location = [];
        if ($this->city) $location[] = $this->city;
        if ($this->state) $location[] = $this->state;
        return implode(', ', $location);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset($this->logo) : null;
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Calcula a porcentagem de conclusão do perfil da empresa
     * 
     * @return int Porcentagem de 0 a 100
     */
    public function getProfileCompletionPercentage(): int
    {
        $filledFields = 0;
        $totalFields = 15;

        if ($this->company_name) $filledFields++;
        if ($this->cnpj) $filledFields++;
        if ($this->phone) $filledFields++;
        if ($this->website) $filledFields++;
        if ($this->description) $filledFields++;
        if ($this->address) $filledFields++;
        if ($this->city) $filledFields++;
        if ($this->state) $filledFields++;
        if ($this->zip_code) $filledFields++;
        if ($this->services && is_array($this->services) && count($this->services) > 0) $filledFields++;
        if ($this->specialties && is_array($this->specialties) && count($this->specialties) > 0) $filledFields++;
        if ($this->company_size) $filledFields++;
        if ($this->employees_count) $filledFields++;
        if ($this->logo) $filledFields++;
        // Redes sociais (pelo menos uma)
        if ($this->facebook || $this->instagram || $this->linkedin || $this->youtube) $filledFields++;

        return (int) round(($filledFields / $totalFields) * 100);
    }
}
