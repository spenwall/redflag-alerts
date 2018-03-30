@extends('layout.layout')


@section('content')
<div class="jumbotron">
    <h1>Alerts</h1>
    @if ($duplicate)
    <div class="duplicate">That is a duplicate entry</div>
    @endif
    <div class="alert-list">
        <div class="alert-title alert-name-title">Name</div>
        <div class="alert-title alert-keywords-title">Keyword</div>
        @foreach ($alerts as $alert)
        <div class="alert-item alert-name">{{ $alert->name }}</div>
        <div class="alert-item alert-keyword">{{ $alert->keywords }}</div>
        @endforeach
    </div>

</div>

@endsection