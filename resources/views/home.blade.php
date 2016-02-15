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
        <div class="panel panel-default">
            <div class="panel-body panel-default">
                <h2>Activities</h2>
                <table class="table">
                    <tbody>
                    @if (count($studyProgress) > 0)
                        @foreach ($studyProgress as $study)
                            <tr>
                                <td align="right">
                                    @if(!empty($user->avatar))
                                        {!! Html::image($user->avatar, $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                    @else
                                        {!! Html::image('images/user_default.jpg', $user->name, ['style' => 'max-height: 60px; max-width:60px']) !!}
                                    @endif
                                </td>
                                <td>
                                    <b>{{ link_to_route('sets.show', $study->name, $study->id) }}</b> (
                                    @if($study->learned_words == 0)
                                        0 %
                                    @else
                                        {{ 
                                            round($study->learned_words / $study->total_words * 100)
                                        }} %
                                    @endif
                                     done)<br>
                                    {{ $study->learned_words }} of {{ $study->total_words }} words learned.
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h3>No Record Found</h3>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
