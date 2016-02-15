<script src="/js/functions.js"></script>
@extends('layouts.app')

@section('title', 'My Sets')

@section('content')

    <div class="col-sm-3">
        <div class="row">
            @include('layouts.user')
        </div>
        <div class="row">
            @include('layouts.feed')
        </div>
    </div>
    <div class="col-sm-9 text-left">
        <div class="panel panel-default">
            <div class="panel-heading">My Sets</div>
            <div class="panel-body">
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
                            {{ link_to_route('sets.edit', 'Edit', $set->id, ['class' => 'btn btn-success btn-block']) }}
                </div>
                        <div class="col-xs-8">
                            <span style=font-size:1.3em>
                                <b>
                                    {{ $set->name }}
                                    @if($set->total)
                                        ( users studying: {{ $set->total }} )
                                    @endif
                                </b>
                            </span> <br>
                            {{  count($set->words) }} Cards |
                            {{ count($set->users) }} Studying |
                            Created {{ $set->created_at->diffForHumans() }}
                            <p>
                                {{ substr($set->description, 0, 65) }}
                                {{ (strlen($set->description) > 65 ? '...' : '') }}
                            </p>
                </div>
                <div class="col-xs-1">
                    {!! Form::open(['method' => 'delete','route' => ['sets.destroy', $set->id],]) !!}
                        {!! Form::submit('Delete', [
                                    'class' => 'btn btn-danger',
                            'onclick' => 'confirmSetDelete(this, event)'
                        ]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
                {!! $sets->links() !!}

    </div>
        </div>
    </div>
@endsection
