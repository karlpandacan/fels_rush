@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Questions for set: <b>{{ $set->name }}</b></div>
                    <div class="panel-body">
                        <div class="col-md-10">
                            {!! Form::open(['method' => 'post', 'route' => 'categories.store', 'files' => 'true']) !!}
                                <div class="form-group">
                                    @for($i = 0; $i < 4; $i++)
                                    <div class="row">
                                        <div class="col-xs-5">
                                            {!! Form::label('category_name', 'Original Word') !!}
                                            {!! Form::text('category_name', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-xs-5">
                                            {!! Form::label('category_name', 'Translated Word') !!}
                                            {!! Form::text('category_name', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-xs-1">
                                            {!! Form::label(null, 'Remove') !!}
                                            {!! Form::button(null, [
                                                'class' => 'glyphicon glyphicon-minus btn btn-danger',
                                                'onclick' => 'removeRow(this);'
                                            ]) !!}
                                        </div>
                                    </div>
                                    @endfor

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-5"></div>
                                            <div class="col-md-2">
                                                {!! Form::button(' Add Option', [
                                                    'class' => 'glyphicon glyphicon-plus btn btn-success',
                                                    'onclick' => 'cloneRow(this);'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-1">
                                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                        </div>
                                        <div class="col-xs-2">
                                            {{ link_to_route('categories.index', 'Cancel', null, ['class' => 'btn btn-danger']) }}
                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
