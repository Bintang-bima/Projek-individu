<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';
    protected $fillable = ['umur', 'bio', 'alamat'];

    /**
     * A profile has many users (a profile is shared/referenced by users).
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'profile_id');
    }
}
