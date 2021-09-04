<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeStoreRequest;
use App\Http\Requests\RecipeUpdateRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    protected $recipe;

    /**
     * RecipeController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->recipe = new Recipe;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recipes = Recipe::with('category', 'user')->orderBy('id', 'desc')->paginate(12);
        if ( $request->has('view_deleted') ) {
            $recipes = Recipe::onlyTrashed()->paginate(12);
        }

       return view('recipes.index', [
           'categories' => Category::orderBy('name', 'asc')->get(),
           'recipes' => $recipes,
           'count' => Recipe::count()
           ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipes.create', [
           'categories' => Category::orderBy('name', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeStoreRequest $request)
    {
        if ( $request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/recipes');
            $image->move($destinationPath, $name);

            auth()->user()->recipes()->create([
                'title' => $request->title,
                'category_id' => $request->category,
                'procedure' => $request->procedure,
                'duration' => $request->duration,
                'ingredients' => $request->ingredients,
                'image' => $name,
            ]);
        } else {
            auth()->user()->recipes()->create([
                'title' => $request->title,
                'category_id' => $request->category,
                'procedure' => $request->procedure,
                'duration' => $request->duration,
                'ingredients' => $request->ingredients,
            ]);
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        // call function format_ingredients from Model
        $this->recipe->format_ingredients($recipe);
        return view('recipes.show', [
           'recipe' => $recipe->load('user', 'category'),
            'comments' => Comment::where('recipe_id', $recipe->id)->orderBy('id', 'desc')->paginate(6),
            'count' => Comment::where('recipe_id', $recipe->id)->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $this->authorize('update', $recipe);
        return view('recipes.edit', [
          'recipe' => $recipe,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(RecipeUpdateRequest $request, Recipe $recipe)
    {
        // authorize
        $this->authorize('update', $recipe);
        // handle recipe image
        $name = $recipe->image;
        if( $request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/recipes');
            $image->move($destinationPath, $name);
            if( $recipe->image ) {
                unlink(public_path('/images/recipes/'.$recipe->image)); // remove old image image
            }
        }
        // update
        $recipe->title = $request->title;
        $recipe->procedure = $request->procedure;
        $recipe->category_id = $request->category;
        $recipe->duration = $request->duration;
        $recipe->ingredients = $request->ingredients;
        $recipe->image = $name;
        $recipe->save();

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $this->authorize('update', $recipe);
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted');
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($slug)
    {
        $this->authorize('has_access');

        Recipe::withTrashed()->whereSlug($slug)->restore();
        return back()->with('success', 'Recipe restored');
    }

    /**
     * Restore all deleted recipes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore_all()
    {
        $this->authorize('has_access');

        Recipe::onlyTrashed()->restore();
        return back()->with('success', 'All Posts restored');
    }

}
