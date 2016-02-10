@extends('layouts.app')

@section('content')
    @include('layouts.user')
    @if(auth()->user()->isAdmin())
        <p>
            {!! Form::open(['method' => 'delete', 'route' => ['users.destroy', $user->id]]) !!}
            {!! Form::submit('Delete User', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </p>
    @endif
    <div class="col-sm-9 text-left">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-3 text-right">
                        <h2>Activities</h2>
                    </div>
                    @if($follow != 'self')
                        <div class="col-xs-2 text-left">
                            <p>
                                @if($follow == 'following')
                                    {!! Form::model($user, array('method' => 'DELETE', 'route' => array('follows.destroy', $user->id))) !!}
                                    {!! Form::submit('Unfollow', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['method' => 'post', 'route' => 'follows.store']) !!}
                                    {!! Form::hidden('uid', $user->id), null !!}
                                    {!! Form::submit('Follow', ['class' => 'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </p>
                        </div>
                    @endif
                    @if(auth()->user()->isAdmin() or  auth()->user()->id == $user->id)
                        <div class="col-xs-2 text-left">
                            <p>
                                {!! Form::open(['method' => 'get', 'route' => ['users.edit', $user->id]]) !!}
                                {!! Form::submit('Edit Profile', ['class' => 'btn btn-info']) !!}
                                {!! Form::close() !!}
                            </p>
                        </div>
                    @endif
                </div>
                <hr>
                @if (count($activities) > 0)
                    @foreach ($activities as $activity)
                        <div class="row"
                             style="margin-top: 15px; margin-bottom: 15px">
                            <div class="col-xs-10 text-left ">
                                {{ $activity->content }}
                                - {{ $activity->created_at->format('Y/m/d') }}
                                @if($activity->lesson_id != 0)
                                    {{ link_to_route('lesson_words.show',
                                        'Review Exam',
                                        $activity->lesson_id,
                                        ['class' => 'btn btn-primary'])
                                    }}
                                @endif
                            </div>
                        </div>
                    @endforeach
                    {!! $activities->render() !!}
                @else
                    <h3>No Record Found</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
