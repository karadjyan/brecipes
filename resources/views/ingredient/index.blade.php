@extends('layouts.app')
@section('title', 'Ингредиенты')
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
            <h3 class="box-title">Ингредиенты</h3>
            <div class="box-tools pull-right">
                <a href="{!! "/home/ingredient/create" !!}" class="btn btn-primary">Добавить ингредиент</a>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="">
                <div class="col-md-2">
                    <div class="input-group">
                        <input id="way" type="hidden" value="ingredient">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Поиск.." value="{{$search}}">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                    </div>
                </div>
            </form>

            <br><br>

            @if($ingredients->count()!=0)
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="bg-primary">
                            <th width="80%">Название</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ingredients as $ingredient)
                            <tr class="bg-white">
                                <td width="80%"><a href="/ingredient/{{$ingredient->id}}">{{$ingredient->name}}</a></td>
                                <td class="text-center">
                                    @if($u_id==$ingredient->u_id)
                                        <a href="/ingredient/{{$ingredient->id}}/edit" class="btn btn-primary btn-sm" title="Изменить"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Удалить" onclick="showFormDelete('/ingredient/', {{$ingredient->id}});"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    @else
                                        <p>Невозможно</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                @if($search==null)
                    <p class="alert alert-info text-center">Список ингредиентов пуст</p>
                @else
                    <p class="alert alert-warning text-center">По запросу <strong>{{$search}}</strong> ничего не найдено.</p>
                @endif
            @endif
        </div>
    </div>


@endsection