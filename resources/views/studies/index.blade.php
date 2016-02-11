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
            <div class="panel-heading">Studying</div>
            <div class="panel-body">
                <table class="table">
                    <tbody>
                    @if (count($sets) > 0)
                        @foreach ($sets as $set)
                            <tr>
                                <td class="col-xs-1 text-right">
                                    {{ Form::open(['method' => 'delete', 'route' => ['studies.destroy', $set->id]]) }}
                                        {!! Form::hidden('sid', $set->id), null !!}
                                        {!! Form::submit('Unstudy', ['class' => 'btn btn-warning']) !!}
                                    {{ Form::close() }}
                                </td>
                                <td class="col-xs-1 text-right">
                                    @if(!empty($set->image))
                                        {!! Html::image('images/sets/' . $set->image, $set->name, ['style' => 'max-height: 60px; max-width: 60px;', 'name' => 'image']) !!}
                                    @else
                                        {!! Html::image('images/cat_default.png', $set->name, ['style' => 'max-height: 60px; max-width: 60px;', 'name' => 'image']) !!}
                                    @endif
                                </td>
                                <td class="col-xs-8 text-left ">
                                    <b>{{ $set->name }}</b> ( {{ $set->created_at->format('Y/m/d') }} )<br>
                                    - {{
                                        substr($set->description, 0, 32) }}
                                        {{ (strlen($set->description) > 32 ? '...' : '')
                                    }}
                                </td>
                                <td class="col-xs-2 text-left ">
                                    {{ link_to_route('sets.show', 'View Lesson', $set->id, ['class' => 'btn-block btn btn-success']) }}
                                </td>
                            </tr>
                        @endforeach
                        {!! $sets->render() !!}
                    @else
                        <h3>No Record Found</h3>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
