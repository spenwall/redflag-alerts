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
        <div class="alert-list" ref="spencer">
            <div class="alert-item alert-name">{{ $alert->name }}</div>
            <div class="alert-item alert-keyword">{{ $alert->keywords }}</div>
        </div>
        <alert></alert>
        @endforeach
    </div
    <a href="{{ route('create-alert') }}"><div class="ion-android-add-circle add"></div></a>

</div>

<script>

Vue.component('alert', {
    data: function () {
            return { 
                posts: 0
        }
    },

    methods: {

        alertPost(alertId) {
            axios.get('alerts/results/'+alertId)
                    .then((results, postName) => {
                        this.posts = results.data.results
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
        }
    },

    template: `
        <div>
        <div v-on:click="alertPost(1)" class="match">
        Click Me
        </div> 
        <div v-for="post in posts" class="match">
            <a :href="post.link" v-text="post.title"></a>
        </div>
        </div>
     `
})

    new Vue({
        el: "#results",

        data: {
            @foreach($alerts as $alert)
            posts{{ $alert->id }}: [],
            @endforeach
            errors: []
        },
        
        methods: {

            getPosts(postName, alertId) {
                console.log(postName)
                axios.get('alerts/results/'+alertId)
                    .then((results, postName) => {
                        this.posts5 = results.data.results
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            },
            call(postName, data) {
                console.log('alertId', postName)
                console.log('data', data.data.results)
                this.posts = data.data.results
                console.log(this.posts)
            }
        }
    })


function call(postName, data) {
    console.log('alertId', postName)
    console.log('data', data.data.results)
    this[postName] = data.data.results
    console.log(this.post5)
}
</script>
@endsection