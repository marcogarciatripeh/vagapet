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
        'address', 'city', 'state', 'zip_code', 'latitude', 'longitude',
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
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
