@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Word</div>
                    <div class="panel-body">
                        <div class="col-md-10">
                            {!! Form::open([
                                'method' => 'patch',
                                'route' => [
                                    'words.update',
                                    $word->id
                                ],
                                'files' => 'true'
                            ]) !!}
                                <div class="form-group">
                                    {!! Form::label('word_category', 'Word Category') !!}
                                    {!! Form::select('word_category', $categories, $word->category['id'], ['class' => 'form-control']) !!}
                                    {!! Form::hidden('word_id', $word->id) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('word_japanese', 'Word Original') !!}
                                    {!! Form::text('word_japanese', $word->word_japanese, ['class' => 'form-control', 'placeholder' => 'Original Word']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('word_vietnamese', 'Word Translated') !!}
                                    {!! Form::text('word_vietnamese', $word->word_vietnamese, ['class' => 'form-control', 'placeholder' => 'Translated Word']) !!}
                                </div>
                                <div class="form-group">
                                    @if(!empty($word->sound_file))
                                        {!! Form::label('audio', 'Word Japanese') !!}
                                        <audio controls>
                                            <source src="{{ asset('audio/' . $word->sound_file) }}">
                                        </audio>
                                    @endif
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
