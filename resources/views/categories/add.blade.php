@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Categories</div>
                    <div class="panel-body">
                        <div class="col-md-10">
                            {!! Form::open(['method' => 'post', 'route' => 'categories.store', 'files' => 'true']) !!}
                                <div class="form-group">
                                    {!! Form::label('category_name', 'Name') !!}
                                    {!! Form::text('category_name', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('category_desc', 'Description') !!}
                                    {!! Form::textarea('category_desc', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('category_image', 'Image') !!}
                                    {!! Form::file('category_image') !!}
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
