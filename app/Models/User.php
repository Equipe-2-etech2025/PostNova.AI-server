<?php

namespace App\Models;

use App\Notifications\ResetPasswordWithFrontendUrl;
use App\Notifications\VerifyEmailCustom;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property bool $isAdmin
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;
    use HasFactory;
    use Notifiable;

    /**
     * User roles constants
     */
    public const ROLE_USER = 'user';

    public const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->role)) {
                $user->role = self::ROLE_USER;
            }
        });
    }

    /**
     * Get available roles.
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_USER => 'Utilisateur',
            self::ROLE_ADMIN => 'Administrateur',
        ];
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Check if user is public client.
     */
    public function isPublic(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    /**
     * Get user's initials.
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return substr($initials, 0, 2);
    }

    /**
     * Scope for users with specific role.
     */
    public function scopeWithRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope for verified users.
     */
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailCustom);
    }

    public function sendPasswordResetNotification($token)
    {
        $url = "hhttps://dev-postnova-web.netlify.app/reset-password?token={$token}&email=".urlencode($this->email);
        $this->notify(new ResetPasswordWithFrontendUrl($url));
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
