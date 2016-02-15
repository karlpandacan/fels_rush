@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="col-sm-3">
        <div class="row">
            @include('layouts.user')
        </div>
        <div class="row">
            {{--@include('layouts.feed')--}}
        </div>
    </div>
    <div class="col-sm-9 text-left">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    {{ Form::open(['url' => '/sets/search', 'method' => 'GET', 'class' => 'form-inline']) }}
                    <div class="form-group">
                        {{  Form::text('q', $wildcard, ['class' => 'form-control input-sm'], null) }}
                    </div>
                    <div class="form-group">
                        {{ Form::select('category', $categories, ($selectedCategory == '' ? 'all' : $selectedCategory), ['class' => 'form-control input-sm']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::select('filter', ['latest' => 'Latest Sets', 'pop' => 'Popular', 'rec' => 'Recommended'], $filter, ['class' => 'form-control input-sm']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Search', ['class' => 'btn btn-primary ']) }}
                    </div>
                    {{ Form::close() }}
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h4>Showing {{$sets->count() }} of {{ $sets->total() }}</h4>
                    </div>
                    <div class="col-sm-12">
                        @if (count($sets) > 0)
                            <table class="table">
                                <tbody>
                                @foreach ($sets as $set)
                                    <tr>
                                        <td class="col-xs-2 text-right">
                                            @if(!auth()->user()->isAdmin())
                                                @if(in_array($set->id, $followedSets))
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
                                            @endif
                                        </td>
                                        <td class="col-xs-1 text-right">
                                            @if(!empty($set->image))
                                                {!! Html::image('images/sets/' . $set->image, $set->name, ['style' => 'max-height: 60px; max-width: 60px;', 'name' => 'image']) !!}
                                            @else
                                                {!! Html::image('images/cat_default.png', $set->name, ['style' => 'max-height: 60px; max-width: 60px;', 'name' => 'image']) !!}
                                            @endif
                                        </td>
                                        <td class="col-xs-7 text-left">
                                            <span style=font-size:1.3em>
                                                <b>
                                                    {{ link_to_route('sets.show', $set->name, $set->id) }}
                                                    @if($set->total)
                                                        ( users studying: {{ $set->total }} )
                                                    @endif
                                                </b>
                                            </span> <br>
                                                by {{ link_to_route('users.show', $user->name, $user->id, null) }}
                                                with {{  count($set->words) }} Cards
                                                created on {{ $set->created_at->format('Y/m/d') }}
                                            <p>
                                                {{ substr($set->description, 0, 65) }}
                                                {{ (strlen($set->description) > 65 ? '...' : '') }}
                                            </p>
                                        </td>
                                        <td class="col-xs-2 text-left">
                                            {{ link_to_route('sets.show', 'View Lesson', $set->id, ['class' => 'btn-block btn btn-success']) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                {!! $sets->appends(['q' => $wildcard, 'category' => $selectedCategory, 'filter' => $filter])->links() !!}
                            </div>

                        @else
                            <h3>No Record Found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
