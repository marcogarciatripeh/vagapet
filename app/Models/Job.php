<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vagas';

    protected $fillable = [
        'company_profile_id', 'title', 'slug', 'description', 'requirements', 'benefits',
        'contract_type', 'area', 'experience_level', 'work_hours',
        'salary_type', 'salary_min', 'salary_max', 'currency',
        'work_location', 'city', 'state', 'is_remote', 'is_hybrid',
        'status', 'is_featured', 'is_urgent', 'deadline', 'published_at',
        'views_count', 'applications_count'
    ];

    protected $casts = [
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
        'is_remote' => 'boolean',
        'is_hybrid' => 'boolean',
        'is_featured' => 'boolean',
        'is_urgent' => 'boolean',
        'published_at' => 'datetime',
        'deadline' => 'date',
        'views_count' => 'integer',
        'applications_count' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title);
            }
        });
    }

    public function companyProfile(): BelongsTo
    {
        return $this->belongsTo(CompanyProfile::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCity($query, string $city)
    {
        return $query->where('city', 'like', "%{$city}%");
    }

    public function scopeByArea($query, string $area)
    {
        return $query->where('area', 'like', "%{$area}%");
    }

    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('area', 'like', "%{$search}%");
        });
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function incrementApplications(): void
    {
        $this->increment('applications_count');
    }
}
