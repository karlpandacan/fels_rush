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
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        {{ Form::open(['url' => '/studies', 'method' => 'GET', 'class' => 'form-inline']) }}
                        <div class="form-group">
                            {{  Form::text('q', $wildcard, ['class' => 'form-control input-sm'], null) }}
                        </div>
                        <div class="form-group">
                            {{ Form::select('category', $categories, ($selectedCategory == '' ? 'all' : $selectedCategory), ['class' => 'form-control input-sm']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Search', ['class' => 'btn btn-primary ']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                    <div class="col-sm-4 text-right">
                        Showing {{ $sets->firstItem().' to '.$sets->lastItem().' of '.$sets->total() }}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        @if (count($studyProgress) > 0)
                            <table class="table">
                                <tbody>
                                    @foreach ($studyProgress as $set)
                                        <tr>
                                            <td class="col-xs-1 text-right">
                                                {{ Form::open(['method' => 'delete', 'route' => ['studies.destroy', $set->id]]) }}
                                                    {!! Form::hidden('sid', $set->id), null !!}
                                                    {!! Form::submit('Unstudy', ['class' => 'btn btn-primary']) !!}
                                                {{ Form::close() }}
                                            </td>
                                            <td class="col-xs-1 text-right">
                                                @if(!empty($set->image))
                                                    {!! Html::image('images/sets/' . $set->image, $set->name, ['style' => 'max-height: 60px; max-width: 60px;', 'name' => 'image']) !!}
                                                @else
                                                    {!! Html::image('images_catch/cat.png', $set->name, ['style' => 'max-height: 60px; max-width: 60px;', 'name' => 'image']) !!}
                                                @endif
                                            </td>
                                            <td class="col-xs-8 text-left ">
                                                <span style=font-size:1.3em>
                                                    <b>{{ $set->name }}</b>
                                                </span>(
                                                    @if($set->learned_words == 0)
                                                        0 %
                                                    @else
                                                        {{
                                                            round($set->learned_words / $set->total_words * 100)
                                                        }} %
                                                    @endif
                                                     done)<br>
                                                by {{ link_to_route('users.show', $user->name, $user->id, null) }} |
                                                {{  $set->words->count() }} Cards |
                                                {{  $set->users->count() }} Studying  |
                                                Created {{ $set->created_at->diffForHumans() }}
                                                <p>
                                                    {{ substr($set->description, 0, 65) }}
                                                    {{ (strlen($set->description) > 65 ? '...' : '') }}
                                                </p>
                                            </td>
                                            <td class="col-xs-2 text-left ">
                                                {{ link_to_route('sets.show', 'View Lesson', $set->id, ['class' => 'btn-block btn btn-success']) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3>No Record Found</h3>
                        @endif
                    </div>
                </div>
            </div>
            @if (count($studyProgress) > 0)
                <div class="panel-footer text-center">
                    {!! $sets->appends(['q' => $wildcard, 'category' => $selectedCategory])->links() !!}
                    <p class="text-center">
                        Showing {{ $sets->firstItem().' to '.$sets->lastItem().' of '.$sets->total() }}
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
