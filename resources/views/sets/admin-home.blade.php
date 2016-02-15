
@extends('layouts.app')

@section('content')<div class="col-sm-12 text-left">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <div class="text-left">Manage Sets</div>
                </div>
                <div class="col-xs-6">
                    <div class="text-right">Showing {{ $sets->firstItem().' to '.$sets->lastItem().' of '.$sets->total() }} </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Made By</th>
                                <th>Set Name</th>
                                <th colspan="3">Actions</th>
                            </tr>
                            @foreach($sets as $set)
                                <tr>
                                    <td>
                                        {{ $set->user->name }} : {{ $set->user->email }}
                                    </td>
                                    <td>
                                        {{ link_to_route('sets.show',
                                                $set->name  . ' (' . count($set->words) . ' cards)', $set->id,
                                                    ['title' => $set->description]
                                                )
                                            }}
                                    </td>
                                    <td>
                                        {{ link_to_route('sets.edit', 'Edit Info', $set->id, ['class' => 'btn btn-success btn-block']) }}
                                    </td>
                                    <td>
                                        {!! Form::open(['method' => 'delete','route' => ['sets.destroy', $set->id],]) !!}
                                            {!! Form::submit('Delete', [
                                                'class' => 'btn btn-danger btn-block',
                                                'onclick' => 'confirmSetDelete(this, event)'
                                            ]) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-12">
                    <div class="text-center">
                        {{ $sets->render() }}
                        <p class="text-center">
                            Showing {{ $sets->firstItem().' to '.$sets->lastItem().' of '.$sets->total() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
