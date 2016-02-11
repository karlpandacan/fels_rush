<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading">Follow Feeds</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    @if (count($activitiesFollow) > 0)
                        @foreach ($activitiesFollow as $activity)
                            <div class="row">
                                <div class="col-xs-12 text-left">
                                    {{ $activity->content }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No Follow Feeds Found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>