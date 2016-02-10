@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Set</h1>

        {!! Form::open(['method' => 'post', 'route' => 'sets.store', 'files' => 'true']) !!}
        <div class="form-group">
            {!! Form::label('set_name', 'Name') !!}
            {!! Form::text('set_name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('set_desc', 'Description') !!}
            {!! Form::textarea('set_desc', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('set_image', 'Image') !!}
            {!! Form::file('set_image') !!}
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-1">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
                <div class="col-xs-2">
                    {{ link_to_route('sets.index', 'Cancel', null, ['class' => 'btn btn-danger']) }}
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
@endsection
