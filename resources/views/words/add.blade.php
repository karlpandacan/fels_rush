@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Word</div>
                    <div class="panel-body">
                        <div class="col-md-10">
                            {!! Form::open(['method' => 'post', 'route' => 'words.store']) !!}
                                <div class="form-group">
                                    {!! Form::label('word_category', 'Word Category') !!}
                                    {!! Form::select('word_category', $categories, null,['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('word_japanese', 'Word Original') !!}
                                    {!! Form::text('word_japanese', null, ['class' => 'form-control', 'placeholder' => 'Original Word']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('word_vietnamese', 'Word Translated') !!}
                                    {!! Form::text('word_vietnamese', null, ['class' => 'form-control', 'placeholder' => 'Translated Word']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::file('sound_file') !!}
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-1">
                                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                        </div>
                                        <div class="col-xs-2">
                                            {{ link_to_route('words.index', 'Cancel', null, ['class' => 'btn btn-danger']) }}
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
