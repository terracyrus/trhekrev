<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'immunity_until',
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

    public function disciplineResults(): HasMany
    {
        return $this->hasMany(DisciplineResult::class);
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

    public function hasCompletedAllCategories(): bool
    {
        // Anzahl aller existierenden Kategorien
        $totalCategories = Category::count();

        // Zählt die Kategorien, in denen der Benutzer eine Disziplin abgeschlossen hat
        $completedCategories = DisciplineResult::where('user_id', $this->id)
            ->whereHas('discipline') // Ensures only valid disciplines are counted
            ->with('discipline.category') // Load the related categories
            ->get()
            ->pluck('discipline.category_id') // Get all category IDs
            ->unique() // Remove duplicates
            ->count(); // Count unique category IDs

        return $completedCategories >= $totalCategories;
    }

    public function numberCompletedCategories(): int
    {
        // Zählt die Kategorien, in denen der Benutzer eine Disziplin abgeschlossen hat
        $completedCategories = DisciplineResult::where('user_id', $this->id)
            ->whereHas('discipline') // Ensures only valid disciplines are counted
            ->with('discipline.category') // Load the related categories
            ->get()
            ->pluck('discipline.category_id') // Get all category IDs
            ->unique() // Remove duplicates
            ->count(); // Count unique category IDs

        return $completedCategories;

    }

    public function isImmune(): bool
    {
        return $this->immunity_until && now()->lt($this->immunity_until);
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
            'immunity_until' => 'datetime',
        ];
    }
}
