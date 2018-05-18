<template>
    <form method="POST" action="/alerts" @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)">
        <div class="field">
            <label class="label" for="name">Alert Name</label>
            <div class="control">
                <input type="text" class="input" id="name" :class="{ 'is-danger' : errors.has('name') }"
                        name="name" placeholder="Alert Name" v-model="name">
            </div>
            <span class="help is-danger" v-if="errors.has('name')" v-text="errors.get('name')"></span>
        </div>

        <div class="field">
            <label class="label" for="keywords">Search Keywords</label>
            <div class="control">
                <input type="text" class="input" id="keywords" :class="{ 'is-danger' : errors.has('keywords') }"
                        name="keywords" placeholder="Search Keywords" v-model="keywords">
            </div>
            <span class="help is-danger" v-if="errors.has('keywords')" v-text="errors.get('keywords')"></span>
        </div>
        
        <button type="submit" class="button is-primary float-right" :disabled="errors.any()">Submit</button>
    </form>
</template>


<script>

export default {
    
    data() {
        return {
            name: '',
            keywords: '',
            errors: new Errors(),
            update: updateView
        }
    },

    methods: {

        onSubmit() {
            
            axios.post('/alerts', this.$data)
                .then(response => {
                    this.onSuccess(response)
                    app.updateAlerts()
                })
                .catch(error => {
                    this.errors.record(error.response.data.errors)
                })
        },

        onSuccess(response) {

            this.name = ''
            this.keywords = ''

        }

    }
}

class Errors {

    constructor() {

        this.errors = {}

    } 

    get(field) {

        if (this.errors[field]) {

            return this.errors[field][0]

        }

    }

    record(errors) {

        this.errors = errors

    }

    clear(field) {

        delete this.errors[field]

    }

    has(field) {

        return this.errors.hasOwnProperty(field)

    }
    
    any() {

        return Object.keys(this.errors).length > 0

    }
}
</script>
