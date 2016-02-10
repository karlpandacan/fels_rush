@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sets</h1>

        {{ link_to_route('sets.create', 'Create Set', null, ['class' => 'btn btn-success']) }}
    </div>
@endsection
