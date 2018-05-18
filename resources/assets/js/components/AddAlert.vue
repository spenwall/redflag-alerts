<template>
    <div>
        <a data-toggle="modal" data-target="#add-alert" @click="active = true">
            <i class="fas fa-plus-circle add"></i>
        </a>
        <modal id="add-alert" title="Add alert" :active.sync="active">
            <create-alert></create-alert> 
        </modal>
    </div>
</template>


<script>
import CreateAlert from './CreateAlert.vue'

export default {
    
    components: {

        'create-alert': CreateAlert

    }, 

    data() {
        return {

            active: false

        }
    } 
}
</script>
