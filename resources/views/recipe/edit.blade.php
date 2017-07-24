@extends('layouts.app')
@section('title', 'Редактирование рецепта')
@section('content')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Редактирование рецепта</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form id="form-recipe" class="form-horizontal" action="/recipe/{{$recipe->id}}" method="post">
                {{csrf_field()}}
                {!! method_field('patch') !!}
                <div class="form-group">
                    <div class="col-md-1">
                        <label class="control-label" for="name">Название</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="name" id="name" value="{{$recipe->name}}">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-md-1">
                        <label class="control-label" for="description">Описание</label>
                    </div>
                    <div class="col-md-11">
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$recipe->description}}</textarea>
                        <script>
                            CKEDITOR.replace( 'description' );
                        </script>
                    </div>
                </div>
                <div class="block-of-ingredients">
                    <div class="col-md-6"><p>Ингридиент</p></div>
                    <div class="col-md-6"><p>Количество</p></div>
                    @foreach($ingredients as $ingredient)
                        <div id="{{$ingredient->id}}" class="form-group ingredient-counter">
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="ingredients[]" value="{{$ingredient->name}}" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="count_ing[]" value="{{$ingredient->count}}" required>
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delete_ing({{$ingredient->id}})">
                                    <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a id="add-ing" href="javascript:void(0)" class="btn btn-default">Добавить ингридиент</a>
                <div class="form-group">
                    <button class="btn btn-primary pull-right RBtnMargin" type="submit">Сохранить рецепт</button>
                </div>
            </form>
        </div>
    </div>
    @include('alerts.error')
@endsection