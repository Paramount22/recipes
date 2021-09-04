<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    protected $recipe;

    /**
     * QueryController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified' ]);
        $this->recipe = New Recipe;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $query = $request->search;
        $recipes = $this->recipe->searchRecipes($query);

        return view('search.index', compact('recipes', 'query'));
    }
}
