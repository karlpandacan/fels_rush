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
                <table class="table">
                    <tbody>
                    @if (count($activities) > 0)
                        @foreach ($activities as $activity)
                            <tr>
                                <td align="right">
                                    @if(!empty($user->avatar))
                                        {!! Html::image($user->avatar, $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                    @else
                                        {!! Html::image('images/user_default.jpg', $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                    @endif
                                </td>
                                <td>
                                    {{ $activity->user->name }} <br>
                                    {{ $activity->content }}
                                    - {{ $activity->created_at->format('Y/m/d') }}
                                    @if($activity->lesson_id != 0 && $activity->user_id == auth()->id())
                                        {{ link_to('results/' . $activity->lesson_id,
                                            'Review Exam',
                                            ['class' => 'btn btn-primary'])
                                        }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        {!! $activities->render() !!}
                    @else
                        <h3>No Record Found</h3>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
