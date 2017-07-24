<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'RecipesController@index')->name('home');

//Ingredient
Route::get('/home/ingredient/create', 'IngredientsController@create');
Route::get('/home/ingredient', 'IngredientsController@index');
Route::post('ingredient/', 'IngredientsController@store');
Route::get('ingredient/{id}/edit', 'IngredientsController@edit');
Route::patch('ingredient/{id}', 'IngredientsController@update');
Route::delete('ingredient/{id}', 'IngredientsController@destroy');
Route::get('/ingredient/autocomplete', ['uses' => 'IngredientsController@autocomplete', 'as' => 'ingredient.autocomplete']);
Route::get('/ingredient/{id}', 'IngredientsController@show');


//Recipe
Route::get('/home/recipe/create', 'RecipesController@create');
Route::post('recipe/', 'RecipesController@store');
Route::get('/home/recipe', 'RecipesController@index');
Route::get('recipe/{id}/edit', 'RecipesController@edit');
Route::patch('recipe/{id}', 'RecipesController@update');
Route::delete('recipe/{id}', 'RecipesController@destroy');
Route::get('/recipe/autocomplete', ['uses' => 'RecipesController@autocomplete', 'as' => 'recipe.autocomplete']);
Route::get('/recipe/{id}', 'RecipesController@show');

//Menu
Route::post('menu/', 'MenusController@store');
Route::get('/home/menu/', 'MenusController@index');
Route::delete('menu/{id}', 'MenusController@destroy');
Route::get('/menu/{id}', 'MenusController@show');
