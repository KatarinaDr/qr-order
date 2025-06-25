<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'license_key',
        'is_active',
        'can_access_dashboard',
        'license_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'can_access_dashboard' => 'boolean',
            'license_expires_at' => 'datetime',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission): bool
    {
        if (! $this->role) {
            return false;
        }

        if ($this->role->name === 'super_admin') {
            return true;
        }

        return $this->role->permissions()->pluck('name')->contains($permission);
    }
    protected static function booted()
    {
        static::saving(function ($user) {
            if ($user->isDirty('is_active') && $user->is_active === true) {
                $user->license_expires_at = now()->addDays(30);
            }

            if ($user->is_active && $user->license_expires_at && $user->license_expires_at->isPast()) {
                $user->is_active = false;
                $user->saveQuietly();
            }
        });
    }

}
