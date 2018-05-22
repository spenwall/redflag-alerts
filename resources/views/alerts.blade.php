@extends('layout.layout')

@section('content')
<div class="box">

    <h1 class="title is-3">Alerts</h1>

    <div id="results">
        <div class="alert-list">
            <div class="alert-title alert-name-title">Name</div>
            <div class="alert-title alert-keywords-title">Keyword</div>
        </div>
    
        <alerts-view ref="alertsView"></alerts-view>
    </div>

    

</div>



@endsection