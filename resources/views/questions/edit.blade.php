<script src="/js/functions.js"></script>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Cards for set: <b>{{ $set->name }}</b></div>
                    <div class="panel-body">
                        <div class="col-md-10">
                            {!! Form::open(['method' => 'post', 'route' => 'words.store', 'files' => 'true']) !!}
                                {{ Form::hidden('set_id', $set->id) }}
                                <div class="form-group">
                                    @if(count($words) == 0)
                                    <div class="row">
                                        <div class="col-xs-5">
                                            {!! Form::label('word_original', 'Original Word') !!}
                                            {!! Form::text('word_original[]', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-xs-5">
                                            {!! Form::label('word_translated', 'Translated Word') !!}
                                            {!! Form::text('word_translated[]', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-xs-1">
                                            {!! Form::label(null, 'Remove') !!}
                                            {!! Form::button(null, [
                                                'class' => 'glyphicon glyphicon-minus btn btn-danger',
                                                'disabled' => true,
                                                'onclick' => 'removeRow(this);'
                                            ]) !!}
                                        </div>
                                    </div>
                                    @endif
                                    @foreach($words as $word)
                                    <div class="row">
                                        {!! Form::hidden('word_id[]', $word->id) !!}
                                        <div class="col-xs-5">
                                            {!! Form::label('word_original', 'Original Word') !!}
                                            {!! Form::text('word_original[]', $word->word_original, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-xs-5">
                                            {!! Form::label('word_translated', 'Translated Word') !!}
                                            {!! Form::text('word_translated[]', $word->word_translated, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-xs-1">
                                            {!! Form::label(null, 'Remove') !!}
                                            {!! Form::button(null, [
                                                'class' => 'glyphicon glyphicon-minus btn btn-danger',
                                                'disabled' => true,
                                                'onclick' => 'removeRow(this);'
                                            ]) !!}
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-5"></div>
                                            <div class="col-md-2">
                                                {!! Form::button(' Add Option', [
                                                    'class' => 'glyphicon glyphicon-plus btn btn-success',
                                                    'onclick' => 'cloneRow();'
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            {!! Form::submit('Save', ['class' => 'btn-block btn btn-primary']) !!}
                                        </div>
                                        <div class="col-xs-2">
                                            {{ link_to_route('sets.edit', 'Cancel', $set->id, ['class' => 'btn-block btn btn-danger']) }}
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
