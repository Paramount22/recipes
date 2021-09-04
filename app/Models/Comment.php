<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_id', 'user_id', 'text'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unlikes()
    {
        return $this->hasMany(Unlike::class);
    }

    /**
     * Kontrola - user nemoze dat like na comment, na ktory uz dal raz like
     * @param User $user
     * @return mixed
     */
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    /**
     * Kontrola - user nemoze dat unlike na comment, na ktory uz dal raz unlike
     * @param User $user
     * @return mixed
     */
    public function unlikedBy(User $user)
    {
        return $this->unlikes->contains('user_id', $user->id);
    }


}
