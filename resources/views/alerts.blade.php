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
        <alert alert-id="{{ $alert->id }}" 
            alert-name="{{ $alert->name }}" 
            keywords="{{ $alert->keywords }}">
        </alert>
        @endforeach
    </div
    <a href="{{ route('create-alert') }}"><div class="ion-android-add-circle add"></div></a>

</div>

<script>

Vue.component('alert', {
    data: function () {
            return { 
                posts: [],
                isLoading: false,
        }
    },

    props: ['alertId', 'alertName', 'keywords'],

    methods: {

        alertPosts() {
            this.isLoading = true
            axios.get('alerts/results/'+this.alertId)
                    .then(results => {
                        this.posts = results.data.results
                        this.isLoading = false
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
        }
    },

    template: `
        <div>
            <div class="alert-list" @click="alertPosts" ref="spencer">
                <div class="alert-item alert-name" v-text="alertName"></div>
                <div class="alert-item alert-keyword" v-text="keywords"></div>
            </div>
            <div class="load-bar" v-if="isLoading">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
                <div v-for="post in posts" class="match">
                <a :href="post.link" v-text="post.title" target="_blank"></a>
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