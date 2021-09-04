<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'category_id', 'user_id', 'procedure', 'ingredients', 'duration', 'image', 'slug'];

    protected $dates = ['deleted_at'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @param $ing
     * @return array
     */
    public function format_ingredients($ing)
    {
        return $ing->ingredients =  $ing->ingredients ? explode(",", $ing->ingredients) : [];
    }

    /** MUTATOR
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
        $this->attributes['slug'] = Str::of($value)->slug('-');
    }



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
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('id', 'desc');
    }

    /**
     * Search functionality
     * @param $request
     * @return mixed
     */
    public function searchRecipes($query)
    {
        $recipes = Recipe::where('title', 'LIKE', '%' . $query . '%')->orWhere('ingredients', 'LIKE', '%' . $query . '%')->paginate(6);
        return $recipes;
    }

}
