@extends('layouts.app')
@section('content')
    <div class="col-sm-12 text-left">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="text-left">Recommended Sets</div>
                    </div>
                    <div class="col-xs-6">
                        <div class="text-right">Showing {{ $recommendedSets->firstItem().' to '.$recommendedSets->lastItem().' of '.$recommendedSets->total() }} </div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-xs-12">
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
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-center">
                            @if(!auth()->user()->isAdmin())
                                {{ $recommendedSets->render() }}
                            @endif
                            <p class="text-center">
                                Showing {{ $recommendedSets->firstItem().' to '.$recommendedSets->lastItem().' of '.$recommendedSets->total() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
