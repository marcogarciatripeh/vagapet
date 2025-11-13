<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

        protected $fillable = [
            'name',
            'email',
            'password',
            'active_profile',
            'is_admin',
            'is_active',
            'status',
        ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function professionalProfile(): HasOne
    {
        return $this->hasOne(ProfessionalProfile::class);
    }

    public function companyProfile(): HasOne
    {
        return $this->hasOne(CompanyProfile::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    // Helper methods
    public function hasProfessionalProfile(): bool
    {
        return $this->professionalProfile()->exists();
    }

    public function hasCompanyProfile(): bool
    {
        return $this->companyProfile()->exists();
    }

    public function switchProfile(string $profile): void
    {
        $this->update(['active_profile' => $profile]);
    }

    public function getActiveProfileAttribute()
    {
        return $this->active_profile ?? 'professional';
    }

        public function getFullNameAttribute(): string
        {
            if ($this->active_profile === 'professional' && $this->professionalProfile) {
                return $this->professionalProfile->first_name . ' ' . $this->professionalProfile->last_name;
            }

            if ($this->active_profile === 'company' && $this->companyProfile) {
                return $this->companyProfile->company_name;
            }

            return $this->name;
        }

        public function isPending(): bool
        {
            return $this->status === 'pending';
        }

        public function isCompleted(): bool
        {
            return $this->status === 'completed';
        }

        public function isInactive(): bool
        {
            return $this->status === 'inactive';
        }

        public function markAsCompleted(): void
        {
            $this->update(['status' => 'completed']);
        }

        public function markAsInactive(): void
        {
            $this->update(['status' => 'inactive']);
        }

        /**
         * Verifica se o usuário pode acessar o painel admin do Filament
         */
        public function canAccessPanel(Panel $panel): bool
        {
            return $this->is_admin === true;
        }
    }
