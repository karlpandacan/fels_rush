@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Recommended Sets</h1>
        <div class="row">
            <div class="col-xs-12">
                    <div class="col-xs-12 text-center">
                        <h4>Showing {{$recommendedSets->count() }} of {{ $recommendedSets->total() }}</h4>
                    </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Made By</th>
                            <th>Set Name</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($recommendedSets as $set)
                            @if($set->user->type != 1)
                            <tr>
                                <td>{{ $set->user->name }}</td>
                                <td>
                                    <b>{{ link_to_route('sets.show', $set->name, $set->id) }}</b>
                                </td>
                                <td>
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
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        @if(count($recommendedSets) == 0)
                            <tr><td colspan="3" align="center">No record found</td></tr>
                        @endif
                    </tbody>
                </table>
                @if(!auth()->user()->isAdmin())
                    {{ $recommendedSets->render() }}
                @endif
            </div>
        </div>

    </div>
@endsection
