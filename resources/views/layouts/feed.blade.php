<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">Recommended Sets</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    @if (count($recommendedSets) > 0)
                        @foreach ($recommendedSets as $set)
                            <div class="row">
                                <p>
                                    <div class="col-xs-4 text-left"><b>{{ $set->name }}</b></div>
                                    <div class="col-xs-4 text-left">by {{ $set->user->name }}</div>
                                    <div class="col-xs-4 text-left">
                                    @if(!auth()->user()->isAdmin())
                                        @if(in_array($set->id, $followed_sets))
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
                                    </div>
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p>No Recommended Sets Found.</p>
                    @endif
                    <div class="col-xs-12 text-center">
                        <b>Page {{ $recommendedSets->currentPage() }}</b>
                    </div>
                    {{ $recommendedSets->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
