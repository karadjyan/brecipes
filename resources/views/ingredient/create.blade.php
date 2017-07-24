@extends('layouts.app')
@section('title', 'Добавление ингредиента')
@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Добавление ингредиента</h3>
        </div>

        <div class="box-body">
            <form class="form-horizontal" action="/ingredient" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-md-1">
                        <label class="control-label" for="name">Название</label>
                    </div>
                    <div class="col-md-4">
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" type="submit">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="box-footer">
            @include('alerts.error')
        </div>

    </div>
@endsection