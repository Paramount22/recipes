<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeStoreRequest;
use App\Http\Requests\RecipeUpdateRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Recipe;

use Illuminate\Http\Request;
use function request as requestAlias;

class RecipeController extends Controller
{


    /**
     * RecipeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'getAllRecipes');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('recipes.index', [
            'categories' => Category::orderBy('name', 'asc')->get(),
            'recipes' => Recipe::with('category', 'user')->orderBy('id', 'desc')
                ->take(5)->get()
            //'count' => Recipe::count()
        ]);
    }

    //public function getRecipes()

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecipeStoreRequest $request)
    {
        $recipe = auth()->user()->recipes()->create([
            'title' => $request->title,
            'category_id' => $request->category,
            'procedure' => $request->procedure,
            'duration' => $request->duration,
            'ingredients' => $request->ingredients,
        ]);

        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $name            = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/recipes');
            $image->move($destinationPath, $name);

            $recipe->update([
                'image' => $name
            ]);
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe created');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Recipe $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        // call function format_ingredients from Model
        //$this->recipe->formatIngredients($recipe);
        //dd($recipe->ingredientsArray);
        return view('recipes.show', [
            'recipe' => $recipe->load('user', 'category'),
            'randomRecipes' => Recipe::with('category', 'user')->inRandomOrder()->limit(4)->get(),
            'comments' => Comment::where('recipe_id', $recipe->id)->orderBy('id', 'desc')->paginate(6),
            'count' => Comment::where('recipe_id', $recipe->id)->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Recipe $recipe
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Recipe $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(RecipeUpdateRequest $request, Recipe $recipe)
    {
        // authorize
        $this->authorize('update', $recipe);
        // handle recipe image
        $name = $recipe->image;
        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $name            = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/recipes');
            $image->move($destinationPath, $name);
            if ($recipe->image) {
                unlink(public_path('/images/recipes/' . $recipe->image)); // remove old image image
            }
        }

        $slug = \Str::of($request->title)->slug('-');
        // update
        $recipe->title       = $request->title;
        $recipe->procedure   = $request->procedure;
        $recipe->category_id = $request->category;
        $recipe->duration    = $request->duration;
        $recipe->ingredients = $request->ingredients;
        $recipe->slug        = $slug;
        $recipe->image       = $name;
        $recipe->save();

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Recipe $recipe
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
    public function restore($id)
    {
//        Recipe::withTrashed()->whereSlug($slug)->restore();
        Recipe::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Recipe restored');
    }

    /**
     * Restore all deleted recipes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAll()
    {
        Recipe::onlyTrashed()->restore();
        return back()->with('success', 'All recipes restored');
    }

    public function delete($id)
    {
        Recipe::findOrFail($id)->delete();
        return back()->with('success', 'Recipes archived');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete($id)
    {
        Recipe::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('recipes.softDeletes')->with('success', 'Recipe deleted forever');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getRecipes(Request $request)
    {
        $recipes = Recipe::with('user', 'category')->orderBy('id', 'desc')
            ->when($request->has('archive'), function ($query) {
                $query->onlyTrashed();
            })->get();
       return view('recipes.archive', compact('recipes'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getAllRecipes()
    {
        return view('recipes.allRecipes', [
            'recipes' => Recipe::with('category', 'user')->orderBy('id', 'desc')->paginate(23)
        ]);
    }


}
