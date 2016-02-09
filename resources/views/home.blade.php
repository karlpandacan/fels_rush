@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    <div class="col-md-3">
                        @if(!empty(auth()->user()->avatar))
                            {!! Html::image(auth()->user()->avatar, auth()->user()->name, ['style' => 'max-height: 250; width:100%']) !!}
                        @else
                            {!! Html::image('images/user_default.png', auth()->user()->name, ['style' => 'max-height: 250; width:100%']) !!}
                        @endif

                        <h2 align="center">{{ auth()->user()->name }}</h2>
                        <h4 align="center">{{ auth()->user()->email }}</h4>
                        @if(!auth()->user()->isAdmin())
                            <h5 align=center>{{ link_to_route('words.search', 'Learned'.$followers.' Words', $parameters = array('status' => 'learned'), null) }}</h5>
                            <h5 align=center>{{ link_to_route('users.search', $followers.' Followers', $parameters = array('t' => 'FRS'), null) }}</h5>
                            <h5 align=center>{{ link_to_route('users.search', $following.' Following', $parameters = array('t' => 'FNG'), null) }}</h5>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h2>Activities</h2>
                        <hr>
                        @if (count($activities) > 0)
                            @foreach ($activities as $activity)
                                <div class="row" style="margin-top: 15px; margin-bottom: 15px">
                                    <div class="col-xs-2 text-right">
                                        <img src="{{ $activity->user->avatar }}" width="60" height="60" >
                                    </div>
                                    <div class="col-xs-10 text-left ">
                                        {{ $activity->user->name }} <br>
                                        {{ $activity->content }} - {{ $activity->created_at->format('Y/m/d') }}
                                        @if($activity->lesson_id != 0 && $activity->user_id == auth()->id())
                                            {{ link_to('results/' . $activity->lesson_id,
                                                'Review Exam',
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
        </div>
    </div>
</div>
@endsection
