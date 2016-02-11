@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Update Set</h1>

        {!! Form::open(['method' => 'patch', 'route' => ['sets.update', $set->id], 'files' => 'true']) !!}
        <div class="row">
            <div class="form-group col-xs-6">
                {!! Form::label('set_category', 'Category') !!}
                {!! Form::select('set_category', $categories, $set->category_id,['class' => 'form-control']) !!}
            </div>


        </div>

        <div class="row">
            <div class="form-group col-xs-6">
                {!! Form::label('set_visibility', 'Visibile to') !!}
                {!! Form::select('set_visibility', $visibilities, $set->visible_to,['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <div class="form-group col-xs-6">
                {!! Form::label('set_name', 'Name') !!}
                {!! Form::text('set_name', $set->name, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-xs-6">
                {!! Form::label('set_image', 'Image') !!}
                {!! Form::file('set_image') !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('set_desc', 'Description') !!}
            {!! Form::textarea('set_desc', $set->description, ['class' => 'form-control']) !!}
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
