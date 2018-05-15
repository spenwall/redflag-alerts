@extends('layout.layout')

@section('content')
<div class="jumbotron">

    <h1>Alerts</h1>

    <div id="results">
        <div class="alert-list">
            <div class="alert-title alert-name-title">Name</div>
            <div class="alert-title alert-keywords-title">Keyword</div>
        </div>
    
        @foreach ($alerts as $alert)
        <alert alert-id="{{ $alert->id }}" 
            alert-name="{{ $alert->name }}" 
            keywords="{{ $alert->keywords }}">
        </alert>
        @endforeach

    </div>

    <a data-toggle="modal" data-target="#add-alert">
        <div class="ion-android-add-circle add"></div>
    </a>

</div>

<modal id="add-alert" title="Add alert">
   <create-alert></create-alert> 
</modal>

@endsection