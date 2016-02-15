
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Manage Sets</h1>
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

        {!! $sets->render() !!}

    </div>
@endsection
