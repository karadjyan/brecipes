@extends('layouts.app')
@section('title', 'Мои меню')
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
            <h3 class="box-title">Мои меню</h3>
            <div class="box-tools pull-right">
                <a href="{!! "/home/recipe" !!}" class="btn btn-primary">Добавить меню</a>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if($menus->count()!=0)
                <div class="col-md-offset-1 col-md-10 table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="bg-primary">
                            <th width="80%">Название</th>
                            <th>Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr class="bg-white">
                                <td width="80%">{{$menu->name}}</td>
                                <td class="text-center">
                                    <a href="/menu/{{$menu->id}}" class="btn btn-success btn-sm" title="Смотреть"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Удалить" onclick="showFormDelete('/menu/', {{$menu->id}});"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="alert alert-info text-center">Список меню пуст</p>
        @endif
        </div>
        <!-- box-footer -->
    </div>
@endsection