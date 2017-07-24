@extends('layouts.app')
@section('title')
    {{$recipe->name}}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><strong>{{$recipe->name}}</strong></h3>
        </div>
        <div class="box-body">
            <p>{!! htmlspecialchars_decode($recipe->description) !!}</p>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <p>Ингридиенты: </p>
            <div class="block-of-ingredients">
                <div class="col-md-10 table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr class="bg-purple">
                            <th>Ингридиент</th>
                            <th>Количество</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ingredients as $ingredient)
                            <tr class="bg-white">
                                <td><a href="/ingredient/{{$ingredient->ingredient_id}}">{{$ingredient->name}}</a></td>
                                <td>{{$ingredient->count}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- box-footer -->
    </div>
    @include('alerts.error')
@endsection