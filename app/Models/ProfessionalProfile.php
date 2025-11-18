<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfessionalProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'birth_date',
        'gender',
        'address',
        'neighborhood',
        'city',
        'state',
        'zip_code',
        'latitude',
        'longitude',
        'bio',
        'title',
        'experience_level',
        'areas',
        'skills',
        'education',
        'experiences',
        'years_experience',
        'photo',
        'resume',
        'linkedin',
        'instagram',
        'facebook',
        'website',
        'views_count',
        'applications_count',
        'is_public',
        'show_in_search',
        'allow_direct_contact',
        'show_current_salary',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'areas' => 'array',
        'skills' => 'array',
        'education' => 'array',
        'experiences' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'views_count' => 'integer',
        'applications_count' => 'integer',
        'is_public' => 'boolean',
        'show_in_search' => 'boolean',
        'allow_direct_contact' => 'boolean',
        'show_current_salary' => 'boolean',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('is_active', true);
        });
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeSearchable($query)
    {
        return $query->where('show_in_search', true)
            ->where(function ($q) {
                // Apenas perfis com 90% ou mais de conclusão aparecem nas buscas
                // 13.5 de 15 campos = 90%
                $q->whereRaw('(
                    (CASE WHEN first_name IS NOT NULL AND first_name != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN last_name IS NOT NULL AND last_name != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN phone IS NOT NULL AND phone != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN birth_date IS NOT NULL THEN 1 ELSE 0 END) +
                    (CASE WHEN gender IS NOT NULL THEN 1 ELSE 0 END) +
                    (CASE WHEN address IS NOT NULL AND address != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN city IS NOT NULL AND city != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN state IS NOT NULL AND state != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN zip_code IS NOT NULL AND zip_code != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN bio IS NOT NULL AND bio != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN title IS NOT NULL AND title != "" THEN 1 ELSE 0 END) +
                    (CASE WHEN experience_level IS NOT NULL THEN 1 ELSE 0 END) +
                    (CASE WHEN areas IS NOT NULL AND JSON_LENGTH(COALESCE(areas, "[]")) > 0 THEN 1 ELSE 0 END) +
                    (CASE WHEN skills IS NOT NULL AND JSON_LENGTH(COALESCE(skills, "[]")) > 0 THEN 1 ELSE 0 END) +
                    (CASE WHEN photo IS NOT NULL AND photo != "" THEN 1 ELSE 0 END)
                ) >= 13.5'); // 13.5 de 15 = 90%
            });
    }

    public function scopeByCity($query, string $city)
    {
        return $query->where('city', 'like', "%{$city}%");
    }

    public function scopeByState($query, string $state)
    {
        return $query->where('state', 'like', "%{$state}%");
    }

    public function scopeByArea($query, string $area)
    {
        return $query->whereJsonContains('areas', $area);
    }

    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('bio', 'like', "%{$search}%")
              ->orWhereJsonContains('skills', $search)
              ->orWhereJsonContains('areas', $search);
        });
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getLocationAttribute(): string
    {
        $location = [];
        if ($this->city) $location[] = $this->city;
        if ($this->state) $location[] = $this->state;
        return implode(', ', $location);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset($this->photo) : null;
    }

    public function getResumeUrlAttribute(): ?string
    {
        return $this->resume ? asset($this->resume) : null;
    }

    // Helper methods
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function incrementApplications(): void
    {
        $this->increment('applications_count');
    }

    /**
     * Calcula a porcentagem de conclusão do perfil
     * 
     * @return int Porcentagem de 0 a 100
     */
    public function getProfileCompletionPercentage(): int
    {
        $filledFields = 0;
        $totalFields = 15;

        if ($this->first_name) $filledFields++;
        if ($this->last_name) $filledFields++;
        if ($this->phone) $filledFields++;
        if ($this->birth_date) $filledFields++;
        if ($this->gender) $filledFields++;
        if ($this->address) $filledFields++;
        if ($this->city) $filledFields++;
        if ($this->state) $filledFields++;
        if ($this->zip_code) $filledFields++;
        if ($this->bio) $filledFields++;
        if ($this->title) $filledFields++;
        if ($this->experience_level) $filledFields++;
        if ($this->areas && is_array($this->areas) && count($this->areas) > 0) $filledFields++;
        if ($this->skills && is_array($this->skills) && count($this->skills) > 0) $filledFields++;
        if ($this->photo) $filledFields++;

        return (int) round(($filledFields / $totalFields) * 100);
    }

    /**
     * Verifica se o perfil está completo o suficiente para aparecer nas buscas (>= 90%)
     * 
     * @return bool
     */
    public function isCompleteEnoughForSearch(): bool
    {
        return $this->getProfileCompletionPercentage() >= 90;
    }
}
