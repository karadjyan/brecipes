<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Recipe;
use Illuminate\Support\Facades\Input;

class IngredientsController extends Controller
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
        $ingredients=null;
        $u_id=Auth::id();
        $search=null;
        if ($request->has('search')) {
            $search=$request->search;
            $ingredients=Ingredient::where('name','like', '%'.$search.'%')->get();
        }
        else{
            $ingredients=Ingredient::get();
        }
        return view("ingredient.index")->with(compact('ingredients','u_id', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredient.create');
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
            'name' => 'required|max:50'
        ]);
        $ingredient = new Ingredient();
        $ingredient->u_id=Auth::id();
        $ingredient->name=$request->name;
        $ingredient->save();
        $request->session()->flash('alert-success', 'Ингредиент добавлен!');
        return redirect("/home/ingredient");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list_recipe = DB::table('ing_rec')->select('recipe_id')->where('ingredient_id', $id)->get();
        $recipes=array();
        for($index=0;$index<count($list_recipe);$index++){
            array_push($recipes,$list_recipe[$index]->recipe_id);
        }
        $recipes = Recipe::whereIn('id',$recipes)->get();
        $ingredient = Ingredient::find($id);
        return view('ingredient.show')->with(compact('ingredient', 'recipes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient=Ingredient::find($id);
        return view("ingredient.edit")->with(compact('ingredient'));
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
            'name' => 'required|max:50'
        ]);
        $ingredient=Ingredient::find($id);
        $ingredient->name=$request->name;
        $ingredient->save();
        $request->session()->flash('alert-success', 'Ингредиент изменён!');
        return redirect("/home/ingredient");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingredient=Ingredient::find($id);
        $ingredient->delete();
        session()->flash('alert-info', 'Ингредиент удалён!');
        return redirect("/home/ingredient");
    }

    public function autocomplete(Request $request){
        if($request->ajax()){
            $search = Input::get('term');
            $ingredients=Ingredient::where('name','like', '%'.$search.'%')->get();
            $resault = [];
            foreach ($ingredients as $ingredient)
            {
                $resault[] = ['id' => $ingredient->id, 'value' => $ingredient->name];
            }
            return response()->json($resault);
        }
    }
}
