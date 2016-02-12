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