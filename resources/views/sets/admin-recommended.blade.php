@extends('layouts.app')
@section('content')
    <div class="col-sm-12 text-left">
        <div class="panel panel-default">
            <div class="panel-heading">Recommended Sets</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-3">Made By</th>
                                                    <th class="col-sm-9">Set Name</th>
                                                    <th class="col-sm-2">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sets as $set)
                                                    @if($set->user->type != 1)
                                                    <tr>
                                                        <td>{{ $set->user->name }}</td>
                                                        <td>{{ $set->name }}</td>
                                                        <td>
                                                            {{ link_to_route('recommendation.store',
                                                                'Recommend', $set->id,
                                                                ['class' => 'btn btn-success btn-block'
                                                            ]) }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                @if(count($sets) == 0)
                                                    <tr><td colspan="3" align="center">No record found</td></tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-3">Made By</th>
                                                    <th class="col-sm-9">Set Name</th>
                                                    <th class="col-sm-2">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recommendedSets as $recommendedSet)
                                                    @if($recommendedSet->user->type != 1)
                                                    <tr>
                                                        <td>{{ $recommendedSet->user->name }}</td>
                                                        <td>{{ $recommendedSet->name }}</td>
                                                        <td>
                                                            {{ link_to_route('recommendation.destroy',
                                                                'Remove', $recommendedSet->id,
                                                                ['class' => 'btn btn-primary btn-block'
                                                            ]) }}
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
