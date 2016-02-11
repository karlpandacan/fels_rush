<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4">
                    @if(!empty($user->avatar))
                        {!! Html::image($user->avatar, $user->name, ['class' => 'img-thumbnail', 'style' => 'min-height: 72px; min-width:72px']) !!}
                    @else
                        {!! Html::image('images/user_default.jpg', $user->name, ['class' => 'img-thumbnail', 'style' => 'min-height: 72px; min-width:72px']) !!}
                    @endif
                </div>
                <div class="col-xs-8">
                    <h4 align="left">{{ $user->name }}</h4>
                    <h5 align="left">{{ $user->email }}</h5>
                </div>
            </div>
            <div class="row">
                @if(!auth()->user()->isAdmin())
                    <div class="col-xs-4">
                        <h5>
                            {!!  HTML::decode(link_to_route(
                                'words.search',
                                "Activities <span style=font-size:1.6em><br>".$learnedWords."</span>",
                                $parameters = array('status' => 'learned'),
                                null
                            )) !!}
                        </h5>
                    </div>
                    <div class="col-xs-4">
                        <h5>
                            {!! HTML::decode(link_to_route(
                                'users.search',
                                "Followers <span style=font-size:1.6em><br>".$followers."</span>",
                                $parameters = array('t' => 'FRS'),
                                null
                             )) !!}
                        </h5>
                    </div>
                    <div class="col-xs-4">
                        <h5>
                            {!! HTML::decode(link_to_route(
                                'users.search',
                                "Following <span style=font-size:1.6em><br>".$following."</span>",
                                $parameters = array('t' => 'FNG'),
                                null
                            )) !!}
                        </h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>