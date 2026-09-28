<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Assessoria;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function assessoria(): BelongsTo
    {
        return $this->belongsTo(Assessoria::class);
    }

    public function coaches(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'coach_athlete',
            'athlete_id',
            'coach_id'
        );
    }

    public function athletes(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'coach_athlete',
            'coach_id',
            'athlete_id'
        );
    }

    public function canCoach(User $athlete): bool
    {
        return $this->role === 'coach'
            && $athlete->role === 'athlete'
            && $this->assessoria_id !== null
            && $this->assessoria_id === $athlete->assessoria_id;
    }

    public function assignAthlete(User $athlete): void
    {
        if (!$this->canCoach($athlete)) {
            throw new \DomainException(
                'O coach e o atleta precisam pertencer à mesma assessoria.'
            );
        }

        $this->athletes()->syncWithoutDetaching($athlete->id);
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}