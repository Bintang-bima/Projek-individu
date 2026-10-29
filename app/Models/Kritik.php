<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kritik extends Model
{
    use HasFactory;

    protected $table = 'kritiks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'comment',
        'rating',
        'film_id',
        'user_id',
    ];

    /**
     * A critique belongs to one film.
     */
    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    /**
     * A critique belongs to one user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
