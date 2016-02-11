<script src="/js/functions.js"></script>
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>My Sets</h1>

        @foreach($sets as $set)
            <div class="row">
                <div class="col-xs-1">
                    @if(in_array($set->id, $followed_sets))
                        {{ Form::open(['method' => 'delete', 'route' => ['studies.destroy', $set->id]]) }}
                            {!! Form::hidden('sid', $set->id), null !!}
                            {!! Form::submit('Unstudy', ['class' => 'btn btn-warning btn-block']) !!}
                        {{ Form::close() }}
                    @else
                        {{ Form::open(['method' => 'post', 'route' => 'studies.store']) }}
                            {!! Form::hidden('sid', $set->id), null !!}
                            {!! Form::submit('Study', ['class' => 'btn btn-primary btn-block']) !!}
                        {{ Form::close() }}
                    @endif
                </div>
                <div class="col-xs-1">
                    {{ link_to_route('sets.edit', 'Edit Info', $set->id, ['class' => 'btn btn-success btn-block']) }}
                </div>
                <div class="col-xs-6">
                    <p><u><h4>
                        {{ link_to_route('sets.show',
                            $set->name  . ' (' . count($set->words) . ' cards)', $set->id,
                                ['title' => $set->description]
                            )
                        }}
                    </h4></u></p>
                </div>
                <div class="col-xs-1">
                    {!! Form::open(['method' => 'delete','route' => ['sets.destroy', $set->id],]) !!}
                        {!! Form::submit('Delete', [
                            'class' => 'btn btn-danger btn-block',
                            'onclick' => 'confirmSetDelete(this, event)'
                        ]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
        {!! $sets->render() !!}

    </div>
@endsection
