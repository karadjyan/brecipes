<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RecipesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recipes=null;
        $search=null;
        if ($request->has('search')) {
            $search=$request->search;
            $recipes = Recipe::where([['u_id', Auth::id()], ['name', 'LIKE', '%'.$search.'%']])->orderBy('id', 'desc')->get();
        }
        else{
            $recipes = Recipe::where('u_id', Auth::id())->orderBy('id', 'desc')->get();
        }
        return view('recipe.index')->with(compact('recipes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'description' => 'required',
            'ingredients.*' =>'required',
            'count_ing.*' =>'required'
        ]);
        $recipe = new Recipe();
        $recipe->name=$request->name;
        $recipe->u_id=Auth::id();
        $recipe->description=$request->description;
        $recipe->save();
        for ($index=0;$index<count($request->ingredients);$index++)
        {
            $ingredient = Ingredient::where('name', $request->ingredients[$index])->get();
            if($ingredient->count()==0)
            {
                $ingredient = new Ingredient();
                $ingredient->name=$request->ingredients[$index];
                $ingredient->u_id = Auth::id();
                $ingredient->save();
            }
            else{
                $ingredient = $ingredient[0];
            }
            DB::table('ing_rec')->insert([
                [
                    'recipe_id' => $recipe->id,
                    'ingredient_id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'count' => $request->count_ing[$index],
                ]
            ]);
        }
        $request->session()->flash('alert-success', 'Рецепт добавлен!');
        return redirect("/home/recipe");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = DB::table('ing_rec')->where('recipe_id', $id)->get();
        return view('recipe.show')->with(compact('recipe','ingredients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $ingredients = DB::table('ing_rec')->where('recipe_id', $id)->get();
        return view('recipe.edit')->with(compact('recipe','ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|max:50',
            'description' => 'required',
            'ingredients.*' =>'required',
            'count_ing.*' =>'required'
        ]);
        $recipe = Recipe::find($id);
        $recipe->name=$request->name;
        $recipe->description=$request->description;
        $recipe->save();
        DB::table('ing_rec')->where('recipe_id', $id)->delete();
        for ($index=0;$index<count($request->ingredients);$index++)
        {
            $ingredient = Ingredient::where('name', $request->ingredients[$index])->get();
            if($ingredient->count()==0)
            {
                $ingredient = new Ingredient();
                $ingredient->u_id = Auth::id();
                $ingredient->name=$request->ingredients[$index];
                $ingredient->save();
            }
            else{
                $ingredient = $ingredient[0];
            }
            DB::table('ing_rec')->insert([
                [
                    'recipe_id' => $recipe->id,
                    'ingredient_id' => $ingredient->id,
                    'name' => $ingredient->name,
                    'count' => $request->count_ing[$index],
                ]
            ]);
        }
        $request->session()->flash('alert-success', 'Рецепт обновлён!');
        return redirect("/home/recipe");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        session()->flash('alert-info', 'Рецепт удалён!');
        return redirect("/home/recipe");
    }

    public function autocomplete(Request $request){
        if($request->ajax()){
            $search = Input::get('term');
            $recipes=Recipe::where('name','like', '%'.$search.'%')->get();
            $resault = [];
            foreach ($recipes as $recipe)
            {
                $resault[] = ['id' => $recipe->id, 'value' => $recipe->name];
            }
            return response()->json($resault);
        }
    }

}
