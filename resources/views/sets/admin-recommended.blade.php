@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Recommended Sets</h1>
        <div class="row">
            <div class="col-xs-5">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Made By</th>
                            <th>Set Name</th>
                            <th>Actions</th>
                        </tr>
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

            <div class="col-xs-1"></div>

            <div class="col-xs-5">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Made By</th>
                            <th>Set Name</th>
                            <th>Actions</th>
                        </tr>
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
@endsection
