<script src="{{ url('/js/learnWords.js') }}"></script>
@extends('layouts.app')

@section('content')
    <div class="col-sm-3">
        <div class="row">
            @include('layouts.user')
        </div>
    </div>
    <div class="col-sm-9">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-2 text-right">
                        @if(!empty($user->image))
                            {!! Html::image($set->image, $set->name, ['class' => 'img-thumbnail', 'style' => 'max-height: 72px; max-width:72px']) !!}
                        @else
                            {!! Html::image('images/user_default.jpg', $set->name, ['class' => 'img-thumbnail', 'style' => 'max-height: 72px; max-width:72px']) !!}
                        @endif
                    </div>
                    <div class="col-xs-10 text-left">
                        <div class="row">
                            <span style=font-size:1.8em>
                                {{ $set->name }}
                                {{ link_to_route(
                                    'sets.edit',
                                    'Edit Info',
                                    $set->id,
                                    ['class' => 'btn btn-success']
                                ) }}
                            </span>
                        </div>
                        <div class="row">
                            <p>
                                {{  count($set->words) }} Cards by
                                {{ link_to_route('users.show', $user->name, $user->id, null) }} created on {{ $set->created_at->format('Y/m/d') }}
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12 text-left">
                        @if (count($set->words) > 0)
                            <div class="row">
                                <div class="col-md-1 text-center">
                                    #
                                </div>
                                <div class="col-md-3 text-center">
                                    Word
                                </div>
                                <div class="col-md-4 text-center">
                                    Answer
                                </div>
                            </div>
                            <br>
                            @foreach($set->words as $word)
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-1 text-center">
                                                {{ $cnt = (isset($cnt) ? $cnt : 0) + 1 }}
                                            </div>
                                            <div class="col-md-3 text-center">
                                                {{ $word->word_original }}
                                            </div>
                                            <div class="col-md-4 text-center" id="{{ $word->id }}">

                                            </div>
                                            <div id="hide-btn-{{ $word->id }}" style="display: none">
                                                <div class="col-md-2 text-center">
                                                    <button class="btn btn-block btn-info" onClick="$('#{{ $word->id }}').html('');$('#hide-btn-{{ $word->id }}').hide(); $('#show-btn-{{ $word->id }}').show();">
                                                        Hide Answer
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="show-btn-{{ $word->id }}">
                                                <div class="col-md-2 text-center">
                                                    <button class="btn btn-block btn-primary" onClick="$('#{{ $word->id }}').html('{{ $word->word_translated }}' );$('#hide-btn-{{ $word->id }}').show(); $('#show-btn-{{ $word->id }}').hide();">
                                                        Show Answer
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <div id="unlearn-btn-{{ $word->id }}" {!! !in_array($word->id, $learnedWordsArr) ? 'style="display: none"'  : '' !!}>
                                                    <button id="btn-unlearn-{{ $word->id }}" type="button" class="btn btn-warning" onClick="unLearnWord( {{ $word->id }} ) ">Unlearn</button>
                                                </div>
                                                <div id="learn-btn-{{ $word->id }}" {!! in_array($word->id, $learnedWordsArr) ? 'style="display: none"'  : '' !!}>
                                                    <button id="btn-learn-{{ $word->id }} type="button" class="btn btn-success" onClick="learnWord( {{ $word->id }} ) ">Learn</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        @else
                            <p>
                                There are no Cards for this set.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection