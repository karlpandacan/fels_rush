@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="col-sm-3">
        <div class="row">
            @include('layouts.user')
        </div>
        <div class="row">
            @include('layouts.feed')
        </div>
    </div>
    <div class="col-sm-9 text-left">
        <div class="panel panel-info">
            <div class="panel-body">
                <h2>Activities</h2>
                <hr>
                @if (count($activities) > 0)
                    @foreach ($activities as $activity)
                        <div class="row">
                            <div class="col-xs-2 text-right">
                                <img src="{{ $activity->user->avatar }}"
                                     width="60" height="60">
                            </div>
                            <div class="col-xs-10 text-left ">
                                {{ $activity->user->name }} <br>
                                {{ $activity->content }}
                                - {{ $activity->created_at->format('Y/m/d') }}
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
@endsection
