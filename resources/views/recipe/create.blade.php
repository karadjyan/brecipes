@extends('layouts.app')
@section('title', 'Добавление рецепта')
@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Добавление рецепта</h3>
        </div>

        <div class="box-body">
            <form class="form-horizontal" action="/recipe" method="post" id="form-recipe">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-md-1">
                        <label class="control-label" for="name">Название</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-md-1">
                        <label class="control-label" for="description">Описание</label>
                    </div>
                    <div class="col-md-11">
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10" required></textarea>
                        <script>
                            CKEDITOR.replace( 'description' );
                        </script>
                    </div>
                </div>

                <div class="block-of-ingredients">
                    <div class="title-ing">
                        <div class="col-md-6"><p>Ингридиент</p></div>
                        <div class="col-md-6"><p>Количество</p></div>
                    </div>
                </div>
                <a id="add-ing" href="javascript:void(0)" class="btn btn-default">Добавить ингридиент</a>

                <div class="form-group">
                    <button class="btn btn-primary pull-right RBtnMargin" type="submit">Сохранить рецепт</button>
                </div>

            </form>
        </div>

        <div class="box-footer">
            @include('alerts.error')
        </div>
    </div>

@endsection