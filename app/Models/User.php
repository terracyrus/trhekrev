<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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
        'role',
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

    public static function getPlayers(): Collection
    {
        return self::where('role', UserRole::USER->value)->get();
    }

    public function roleEnum(): UserRole
    {
        return UserRole::from($this->role);
    }

    public function isUser(): bool
    {
        return $this->roleEnum()->isUser();
    }

    public function isOperator(): bool
    {
        return $this->roleEnum()->isOperator();
    }

    public function isAdmin(): bool
    {
        return $this->roleEnum()->isAdmin();
    }

    public function disciplineResults(): BelongsToMany
    {
        return $this->belongsToMany(DisciplineResult::class);
    }

    public function overallLeaderboard(): HasOne
    {
        return $this->hasOne(OverallLeaderboard::class);
    }

    public function firstLeaderboard(): HasOne
    {
        return $this->hasOne(FirstLeaderboard::class);
    }

    public function completedDisciplines(): int
    {
        return DisciplineResult::where('user_id', $this->id)->distinct('discipline_id')->count();
    }

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
        ];
    }
}
