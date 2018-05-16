<template>
    <form method="POST" action="/alerts" @submit.prevent="onSubmit" @keydown="errors.clear($event.target.name)">
        <div class="form-group">
                <label for="name">Alert Name</label>
                <input type="text" class="form-control" id="name" 
                        name="name" placeholder="Alert Name" v-model="name"
                        >
                <span class="help text-danger" v-if="errors.has('name')" v-text="errors.get('name')"></span>
                
        </div>

        <div class="form-group">
                <label for="keywords">Search Keywords</label>
                <input type="text" class="form-control" id="keywords" 
                        name="keywords" placeholder="Search Keywords" v-model="keywords">
                <span class="help text-danger" v-if="errors.has('keywords')" v-text="errors.get('keywords')"></span>
        </div>
        
        <button type="submit" class="btn btn-primary float-right" :disabled="errors.any()">Submit</button>
    </form>
</template>


<script>

export default {
    data() {
        return {
            name: '',
            keywords: '',
            errors: new Errors(),
        }
    },

    methods: {

        onSubmit() {
            
            axios.post('/alerts', this.$data)
                .then(response => {
                    this.onSuccess(response)
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
