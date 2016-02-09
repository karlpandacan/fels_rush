@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">

                    @if(session()->has('message_success'))
                        <ul class="alert alert-success">
                            <li>{{ session('message_success') }}</li>
                        </ul>
                    @endif
                    @if(session()->has('message_failed'))
                        <ul class="alert alert-danger">
                            <li>{{ session('message_failed') }}</li>
                        </ul>
                    @endif
                    <div class="col-md-3">
                        @if(!empty(auth()->user()->avatar))
                            {!! Html::image(auth()->user()->avatar, auth()->user()->name, ['style' => 'max-height: 250; width:100%']) !!}
                        @else
                            {!! Html::image('images/user_default.png', auth()->user()->name, ['style' => 'max-height: 250; width:100%']) !!}
                        @endif
                        <h2 align="center">{{ auth()->user()->name }}</h2>
                        <h4 align="center">{{ auth()->user()->email }}</h4>
                        @if(auth()->user()->isAdmin())
                            <p>
                                <a href="{{ url('users/create') }}" class="btn btn-primary">Add User</a>
                            </p>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" {{ $tab == 'NF' ? 'class=active' : '' }}>
                                <a href="#following" aria-controls="profile" role="tab" data-toggle="tab">Not Following ({{ count($usersNotFollowing) }})</a>
                            </li>
                            <li role="presentation" {{ $tab == 'FNG' ? 'class=active' : '' }}>
                                <a href="#not_following" aria-controls="home" role="tab" data-toggle="tab">Following ({{ count($usersFollowing) }})</a>
                            </li>
                            <li role="presentation" {{ $tab == 'FRS' ? 'class=active' : '' }}>
                                <a href="#followers" aria-controls="home" role="tab" data-toggle="tab">Followers ({{ count($usersFollowers) }})</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpane1" class="tab-pane fade {{ $tab == 'NF' ? 'in active' : '' }}" id="following" width="100%">
                                @if (count($usersNotFollowing) > 0)
                                    @foreach ($usersNotFollowing as $user)
                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px">
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
                            <div role="tabpane2" class="tab-pane fade {{ $tab == 'FNG' ? 'in active' : '' }}" id="not_following">
                                @if (count($usersFollowing) > 0)
                                    @foreach ($usersFollowing as $user)
                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px">
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
                            <div role="tabpane2" class="tab-pane fade {{ $tab == 'FRS' ? 'in active' : '' }}" id="followers">
                                @if (count($usersFollowers) > 0)
                                    @foreach ($usersFollowers as $user)
                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
