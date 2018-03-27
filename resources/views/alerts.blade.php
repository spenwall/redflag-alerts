@extends('layout.layout')


@section('content')
<div class="jumbotron">
    <h1>Here are your current Alerts</h1>
    <div class="col-sm-12">
        <div class="alert-name-title col-sm-2">Name</div>
        <div class="alert-keyword-title col-sm-2">Keyword</div>
        @foreach ($alerts as $alert)
        <div class="alert-name col-sm-2">{{ $alert->name }}</div>
        <div class="alert-keyword col-sm-2">{{ $alert->keywords }}</div>
        @endforeach
    </div>

</div>

@endsection