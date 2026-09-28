<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Assessoria extends Model
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function coaches(): HasMany
    {
        return $this->hasMany(User::class)->where('role', 'coach');
    }

    public function athletes(): HasMany
    {
        return $this->hasMany(User::class)->where('role', 'athlete');
    }
}
