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

    <a href="{{ route('create-alert') }}" data-toggle="modal" data-target="#exampleModal">
        <div class="ion-android-add-circle add"></div>
    </a>

</div>

<modal title="Add alert">
    <form method="POST" action="/alerts">
        @csrf
        <div class="form-group">
                <label for="name">Alert Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Alert Name" required>
        </div>

        <div class="form-group">
                <label for="keywords">Search Keywords</label>
                <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Search Keywords" required>
        </div>
        
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
</modal>

@endsection