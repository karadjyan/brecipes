@extends('layouts.app')
@section('title')
    {{$menu->name}}
@endsection
@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{$menu->name}}</h3>
            <div class="box-tools pull-right">
                <a href="javascript:history.back()" class="btn btn-primary">Назад</a>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-offset-1 col-md-10 table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="bg-primary">
                        <th width="80%">Название</th>
                        <th class="text-center">Количество</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ingredients as $ingredient)
                        <tr class="bg-white">
                            <td width="80%">{{$ingredient->name}}</td>
                            <td class="text-center">
                                {{$ingredient->count}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->
@endsection