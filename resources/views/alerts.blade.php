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
            <div v-on:click="getPosts({{ $alert->id }})" class="alert-item alert-keyword">{{ $alert->keywords }}</div>
        </div>
        <div id="{{ $alert->id }}" v-for="post in posts" class="match">
            <a :href="post.link" v-text="post.title"></a>
        </div>
        @endforeach
    </div>
    <a href="{{ route('create-alert') }}"><div class="ion-android-add-circle add"></div></a>

</div>

<script>

    new Vue({
        el: "#results",

        data: {
            posts: [],
            errors: []
        },
        
        methods: {

            getPosts(alertId) {
                
                axios.get('alerts/results/'+alertId)
                    .then(response => (
                        this.posts = response.data.data
                    ))
                    .catch(e => {
                        this.errors.push(e)
                    })
            }

        }

    })

</script>
@endsection