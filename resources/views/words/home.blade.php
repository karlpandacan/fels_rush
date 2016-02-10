@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Words</div>
                    <div class="panel-body">
                        @if(auth()->user()->isAdmin())
                            {!! Form::open(['method' => 'get', 'route' => 'words.create']) !!}
                            {!! Form::submit('Add Word', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}
                        @endif
                        <br>

                        {!! Form::open(['method' => 'get', 'route' => ['words.search']]) !!}
                            <div class="col-xs-2">
                                {!! Form::select('category', $categories, $category_id) !!}
                            </div>
                            <div class="col-xs-2">
                                {!! Form::select('status', ['All', 'Learned', 'Unlearned'], $status) !!}
                            </div>
                            <div class="col-xs-6">
                                {!! Form::submit('Filter', ['class' => 'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                        @foreach($words as $word)
                            <div class="row">
                                <div class="col-xs-3">
                                    {{ $word->word_original }}
                                </div>
                                <div class="col-xs-1">
                                    :
                                </div>
                                <div class="col-xs-4">
                                    {{ $word->word_translated }}
                                </div>
                                <div class="col-xs-2">
                                    @if(auth()->user()->isAdmin())
                                    <div class="row">
                                        <div class="col-xs-4">
                                            {!! Form::open(['method' => 'get', 'route' => ['words.edit', $word->id]]) !!}
                                            {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="col-xs-4">
                                            {!! Form::open(['method' => 'delete', 'route' => ['words.destroy', $word->id]]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <br>
                        @endforeach
                        {{ $words->appends(['status' => $status, 'category' => $category_id])->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
