<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenusController extends Controller
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
    public function index()
    {
        $menus = DB::table('menus')->where('u_id',Auth::id())->orderBy('id', 'desc')->get();
        return view('menu.index')->with(compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name_menu" => "required|min:3"
        ]);
        DB::table('menus')->insert(['name' => $request->name_menu, 'u_id' => Auth::id(),]);
        $id_menu = DB::table('menus')->select('id')->where([['u_id', Auth::id()], ['name',$request->name_menu]])->get();
        for($index=0;$index<count($request->menus);$index++)
        {
            DB::table('menu_content')->insert(['m_id' => $id_menu[0]->id, 'r_id' => $request->menus[$index],]);
        }
        $request->session()->flash('alert-success', 'Меню добавлено!');
        return redirect("/home/menu");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = DB::table('menus')->find($id);
        $db_recipes = DB::table('menu_content')->select('r_id')->where('m_id',$id)->get();
        $recipes=array();
        for($index=0;$index<count($db_recipes);$index++){
            array_push($recipes,$db_recipes[$index]->r_id);
        }
        $ingredients = DB::table('ing_rec')->whereIn('recipe_id',$recipes)->get();
        return view('menu.show')->with(compact('ingredients', 'menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('menus')->where('id',$id)->delete();
        session()->flash('alert-info', 'Меню удалёно!');
        return redirect("/home/menu");
    }
}
