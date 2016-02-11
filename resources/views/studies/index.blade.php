@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @include('layouts.user')
    <div class="col-sm-9 text-left">
        <div class="panel panel-info">

            <div class="panel-heading">Studying</div>
            <div class="panel-body">
                @if (count($sets) > 0)
                    @foreach ($sets as $set)
                        <div class="row">
                            <div class="col-xs-2 text-right">
                                <img src="{{ $set->image }}"
                                     width="60" height="60">
                            </div>
                            <div class="col-xs-10 text-left ">
                                {{ $set->name }} <br>
                                - {{ $set->created_at->format('Y/m/d') }}
                            </div>
                        </div>
                    @endforeach
                    {!! $sets->render() !!}
                @else
                    <h3>No Record Found</h3>
                @endif
            </div>
        </div>
    </div>
@endsection
