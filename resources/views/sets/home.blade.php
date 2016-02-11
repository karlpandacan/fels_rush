<script src="/js/functions.js"></script>
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Sets</h1>

        @foreach($sets as $set)
            <div class="row">
                <div class="col-xs-1">{{ link_to_route('sets.edit', 'Edit', $set->id, ['class' => 'btn btn-success']) }}</div>
                <div class="col-xs-6">
                    <p><u><h4>{{ link_to_route('sets.show', $set->name, $set->id) }}</h4></u></p>
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

    </div>
@endsection
