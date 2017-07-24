@extends('layouts.app')
@section('title', 'Изменение ингредиента')
@section('content')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Изменение ингредиента</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-horizontal" action="/ingredient/{{$ingredient->id}}" method="post">
                {{csrf_field()}}
                {!! method_field('patch') !!}
                <div class="form-group">
                    <div class="col-md-1">
                        <label class="control-label" for="name">Название</label>
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="name" id="name" value="{{$ingredient->name}}">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            @include('alerts.error')
        </div>
        <!-- box-footer -->
    </div>
    <!-- /.box -->
@endsection