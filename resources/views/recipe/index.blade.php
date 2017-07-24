@extends('layouts.app')
@section('title', 'Мои рицепты')
@section('content')
    <div class="delete-container">
        <div class="form-delete-container is-Responsive block">
            <form id="form-delete" action="" method="post">
                {{csrf_field()}}
                {!! method_field('delete') !!}
                <p>Вы действительно хотите удалить эту запись?</p>
                <button type="submit" class="btn btn-success">Да</button>
                <a href="javascript:void(0)" class="btn btn-danger" onclick="hideFormDelete();">Нет</a>
            </form>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Мои Рецепты</h3>
            <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <a href="{!! "/home/recipe/create" !!}" class="btn btn-primary">Добавить рецепт</a>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="">
                <div class="col-md-2">
                    <div class="input-group">
                        <input id="way" type="hidden" value="recipe">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Поиск.." value="{{$search}}">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                    </div>
                </div>
            </form>

            <br><br>

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
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recipes as $recipe)
                                <tr class="bg-white">
                                    <td><input type="checkbox" name="menus[]" value="{{$recipe->id}}"></td>
                                    <td min-width="40%">{{$recipe->name}}</td>
                                    <td max-width="40%">{!! htmlspecialchars_decode(mb_strcut($recipe->description,0,200)."...") !!}</td>
                                    <td class="text-center" width="20%">
                                        <a href="/recipe/{{$recipe->id}}" class="btn btn-success btn-sm" title="Смотреть"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="/recipe/{{$recipe->id}}/edit" class="btn btn-primary btn-sm" title="Изменить"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Удалить" onclick="showFormDelete('/recipe/', {{$recipe->id}});"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
                @if($search==null)
                    <p class="alert alert-info text-center">Список рецептов пуст</p>
                @else
                    <p class="alert alert-warning text-center">По запросу <strong>{{$search}}</strong> ничего не найдено.</p>
                @endif
            @endif
        </div>

        <!-- box-footer -->
    </div>
    <!-- /.box -->

@endsection