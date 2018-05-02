@extends('layout.layout')


@section('content')
<div class="jumbotron">
    <h1>Alerts</h1>
    @if ($duplicate)
    <div class="duplicate">That is a duplicate entry</div>
    @endif
    <div id="results">
        <div class="alert-list">
            <div class="alert-title alert-name-title">Name</div>
            <div class="alert-title alert-keywords-title">Keyword</div>
        </div>
    
        @foreach ($alerts as $alert)
        <div class="alert-list">
            <div class="alert-item alert-name">{{ $alert->name }}</div>
            <div v-on:click="addCounter('spencer')" class="alert-item alert-keyword">{{ $alert->keywords }}</div>
        </div>
        <div v-for="count in counter" class="match">
            @{{ count }}
        </div>
        @endforeach
    </div>
    <a href="{{ route('create-alert') }}"><div class="ion-android-add-circle add"></div></a>

</div>

<script>
    
    new Vue({
        el: "#results",

        data: {
            counter: []
        },
        
        methods: {

            addCounter(add) {
                
                this.counter.push(add)

            }

        }

    })

</script>
@endsection