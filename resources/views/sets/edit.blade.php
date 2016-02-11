@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Update Set</h1>
        <div class="row">
        {!! Form::open(['method' => 'patch', 'route' => ['sets.update', $set->id], 'files' => 'true']) !!}
            <div class="col-xs-6">
                <div class="row form-group">
                    {!! Form::label('set_category', 'Category') !!}
                    {!! Form::select('set_category', $categories, $set->category_id, ['class' => 'form-control']) !!}
                </div>

                <div class="row form-group">
                        {!! Form::label('set_visibility', 'Visibile to') !!}
                        {!! Form::select('set_visibility', $visibilities, $set->visible_to, ['class' => 'form-control']) !!}
                </div>

                <div class="row form-group">
                    {!! Form::label('set_name', 'Name') !!}
                    {!! Form::text('set_name', $set->name, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-xs-1"></div>

            <div class="col-xs-5">
                <div class="row">
                    <div class="form-group">
                        {!! Form::label('image', 'Current Image') !!}<br>
                        @if(!empty($set->image))
                            {!! Html::image('images/sets/' . $set->image, $set->name, ['style' => 'max-height: 125px;', 'name' => 'image']) !!}
                        @else
                            {!! Html::image('images/cat_default.png', $set->name, ['style' => 'max-height: 125px;', 'name' => 'image']) !!}
                        @endif
                    </div>
                </div>

                <div class="row">
                    {!! Form::label('set_image', 'New Image') !!}
                    {!! Form::file('set_image') !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                {!! Form::label('set_desc', 'Description') !!}
                {!! Form::textarea('set_desc', $set->description, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-2">
                        {!! Form::submit('Save', ['class' => 'btn-block btn btn-primary']) !!}
                    </div>
                    <div class="col-xs-2">
                        {{ link_to_route('questions.edit', 'Edit Cards', $set->id, ['class' => 'btn btn-success btn-block']) }}
                    </div>
                    <div class="col-xs-2">
                        {{ link_to_route('sets.index', 'Cancel', null, ['class' => 'btn-block btn btn-danger']) }}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

    </div>
@endsection
