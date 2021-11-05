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


    /** MUTATOR
     * @param $value
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }

    /*Accessors*/

    /**
     * @return array
     */
    public function getIngredientsArrayAttribute()
    {
        return $this->ingredients =  $this->ingredients ? explode(",", $this->ingredients) : [];
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
        $recipes = Recipe::with('category', 'comments')
            ->where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('ingredients', 'LIKE', '%' . $query . '%')
            ->orWhere('procedure', 'LIKE', '%' . $query . '%')
            ->paginate(12);
        return $recipes;
    }

    /**
     * @param $query
     *  // v controlleri zavolame iba metodu filter
     */
  /*  public function scopeFilter($query)
    {
        // search functionality
        if(request('search')) {
            $query->where('title', 'like', '%'.request('search').'%')
                ->orWhere('procedure', 'like', '%'.request('search').'%')
                ->orWhere('ingredients', 'like', '%'.request('search').'%');
        }
    }*/


    // generate slug
    protected static function boot()
    {
        parent::boot();
        // registering a callback to be executed upon the creation of an recipe
        static::creating(function($recipe) {
            // produce a slug based on the recipe title
            $slug = Str::of($recipe->title)->slug('-');
            // check to see if any other slugs exist that are the same & count them
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            // if other slugs exist that are the same, append the count to the slug
            $recipe->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

}
