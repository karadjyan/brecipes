@extends('layouts.app')
@section('title')
    {{$ingredient->name}}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Рецепты с ингредиентом <strong>{{$ingredient->name}}</strong></h3>
            <div class="box-tools pull-right">
                <a href="javascript:history.back()" class="btn btn-primary">Назад</a>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if($recipes->count()!=0)
                <div class="col-md-12 table-responsive">
                    <form action="/menu" method="post">
                        {{csrf_field()}}
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr class="bg-primary">
                                <th>#</th>
                                <th min-width="40%">Рецепт</th>
                                <th max-width="40%">Описание</th>
                                <th class="text-center">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recipes as $recipe)
                                <tr class="bg-white">
                                    <td><input type="checkbox" name="menus[]" value="{{$recipe->id}}"></td>
                                    <td min-width="40%">{{$recipe->name}}</td>
                                    <td max-width="40%">{!! htmlspecialchars_decode(mb_strcut($recipe->description,0,200)."...") !!}</td>
                                    <td class="text-center">
                                        <a href="/recipe/{{$recipe->id}}" class="btn btn-success btn-sm" title="Смотреть"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="form-menu">
                            <div class="col-md-6"><input class="form-control" type="text" name="name_menu" id="name_menu" required placeholder="Название меню"></div>
                            <div class="col-md-3"><input type="submit" class="btn btn-primary" value="Сохранить меню"></div>
                        </div>
                    </form>

                </div>
            @else
                    <p class="alert alert-info text-center">Список рецептов пуст</p>
            @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            @include('alerts.error')
        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->
@endsection