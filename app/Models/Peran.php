<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peran extends Model
{
    use HasFactory;
    protected $table = 'perans';
    protected $fillable = ['actor', 'film_id', 'cast_id'];

    /**
     * A role (peran) belongs to one film.
     */
    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    /**
     * A role (peran) belongs to one cast.
     */
    public function cast(): BelongsTo
    {
        return $this->belongsTo(Cast::class, 'cast_id');
    }
}
