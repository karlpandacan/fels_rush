@extends('layouts.app')

@section('content')
    <div class="col-sm-9 text-left">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-9">
                    @if(!auth()->user()->isadmin())
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" {{ $tab == 'NF' ? 'class=active' : '' }}>
                                <a href="#following" aria-controls="profile"
                                   role="tab"
                                   data-toggle="tab">Not Following
                                    ({{ count($usersNotFollowing) }})</a>
                            </li>
                            <li role="presentation" {{ $tab == 'FNG' ? 'class=active' : '' }}>
                                <a href="#not_following" aria-controls="home"
                                   role="tab"
                                   data-toggle="tab">Following
                                    ({{ count($usersFollowing) }}
                                    )</a>
                            </li>
                            <li role="presentation" {{ $tab == 'FRS' ? 'class=active' : '' }}>
                                <a href="#followers" aria-controls="home"
                                   role="tab"
                                   data-toggle="tab">Followers
                                    ({{ count($usersFollowers) }}
                                    )</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpane1"
                                 class="tab-pane fade {{ $tab == 'NF' ? 'in active' : '' }}"
                                 id="following" width="100%">
                                @if (count($usersNotFollowing) > 0)
                                    @foreach ($usersNotFollowing as $user)
                                        <div class="row"
                                             style="margin-top: 15px; margin-bottom: 15px">
                                            <div class="col-xs-2 text-right">
                                                @if(!empty($user->avatar))
                                                    {!! Html::image($user->avatar, $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                                @else
                                                    {!! Html::image('images/user_default.png', $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                                @endif
                                            </div>
                                            <div class="col-xs-3 text-left">
                                                <p>
                                                    <a href="/users/{{ $user->id }}">
                                                        <h4>{{ $user->name }}</h4>
                                                        <h5>{{ $user->email }}</h5>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="col-xs-2 text-left">
                                                {!! Form::open(['method' => 'post', 'route' => 'follows.store']) !!}
                                                {!! Form::hidden('uid', $user->id), null !!}
                                                {!! Form::submit('Follow', ['class' => 'btn btn-primary']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h3>No Record Found</h3>
                                @endif
                            </div>
                            <div role="tabpane2"
                                 class="tab-pane fade {{ $tab == 'FNG' ? 'in active' : '' }}"
                                 id="not_following">
                                @if (count($usersFollowing) > 0)
                                    @foreach ($usersFollowing as $user)
                                        <div class="row"
                                             style="margin-top: 15px; margin-bottom: 15px">
                                            <div class="col-xs-2 text-right">
                                                @if(!empty($user->avatar))
                                                    {!! Html::image($user->avatar, $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                                @else
                                                    {!! Html::image('images/user_default.png', $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                                @endif
                                            </div>
                                            <div class="col-xs-3 text-left">
                                                <p>
                                                    <a href="/users/{{ $user->id }}">
                                                        <h4>{{ $user->name }}</h4>
                                                        <h5>{{ $user->email }}</h5>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="col-xs-2 text-left">
                                                {!! Form::model($user, array('method' => 'DELETE', 'route' => array('follows.destroy', $user->id))) !!}
                                                {!! Form::submit('Unfollow', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h3>No Record Found</h3>
                                @endif
                            </div>
                            <div role="tabpane2"
                                 class="tab-pane fade {{ $tab == 'FRS' ? 'in active' : '' }}"
                                 id="followers">
                                @if (count($usersFollowers) > 0)
                                    @foreach ($usersFollowers as $user)
                                        <div class="row"
                                             style="margin-top: 15px; margin-bottom: 15px">
                                            <div class="col-xs-2 text-right">
                                                @if(!empty($user->avatar))
                                                    {!! Html::image($user->avatar, $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                                @else
                                                    {!! Html::image('images/user_default.png', $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                                @endif
                                            </div>
                                            <div class="col-xs-3 text-left">
                                                <p>
                                                    <a href="/users/{{ $user->id }}">
                                                        <h4>{{ $user->name }}</h4>
                                                        <h5>{{ $user->email }}</h5>
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="col-xs-2 text-left">
                                                @if(auth()->user()->followers()->where('follower_id', $user->id)->exists())
                                                    {!! Form::model($user, array('method' => 'DELETE', 'route' => array('follows.destroy', $user->id))) !!}
                                                    {!! Form::submit('Unfollow', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    {!! Form::open(['method' => 'post', 'route' => 'follows.store']) !!}
                                                    {!! Form::hidden('uid', $user->id), null !!}
                                                    {!! Form::submit('Follow', ['class' => 'btn btn-primary']) !!}
                                                    {!! Form::close() !!}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h3>No Record Found</h3>
                                @endif
                            </div>
                        </div>
                    @else
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <div class="row"
                                     style="margin-top: 15px; margin-bottom: 15px">
                                    <div class="col-xs-2 text-right">
                                        @if(!empty($user->avatar))
                                            {!! Html::image($user->avatar, $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                        @else
                                            {!! Html::image('images/user_default.png', $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                        @endif
                                    </div>
                                    <div class="col-xs-3 text-left">
                                        <p>
                                            <a href="/users/{{ $user->id }}">
                                                <h4>{{ $user->name }}</h4>
                                                <h5>{{ $user->email }}</h5>
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-xs-2 text-left">
                                        {{ link_to_route('users.edit', 'Edit', $user->id, ['class' => 'btn btn-primary']) }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>No Record Found</h3>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
