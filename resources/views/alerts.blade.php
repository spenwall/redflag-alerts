@extends('layout.layout')

@section('content')
<div class="box">

    <h1 class="title is-3">Alerts</h1>

    <div id="results">
        <div class="alert-list">
            <div class="alert-title alert-name-title">Name</div>
            <div class="alert-title alert-keywords-title">Keyword</div>
        </div>
    
        <alerts-view></alerts-view>

    </div>

    <a data-toggle="modal" data-target="#add-alert">
        <i class="fas fa-plus-circle add"></i>
    </a>

</div>

<modal id="add-alert" title="Add alert">
   <create-alert></create-alert> 
</modal>

@endsection