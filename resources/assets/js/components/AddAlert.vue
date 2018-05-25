<template>
    <div class="add-alert">
        <a data-toggle="modal" data-target="#add-alert" @click="active = true">
            <div class="tooltip tooltip-right" data-tooltip="Add Alert">
                <i class="fas fa-plus-circle add"></i>
            </div>
        </a>
        <modal id="add-alert" title="Add alert" :active.sync="active">
            <create-alert @update="update"></create-alert> 
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
    },

    methods: {
        update() {
            this.$emit('update')
            this.active = false
        }
    } 
}
</script>

<style>

.add-alert {
    display: flex;
    flex-direction: row-reverse;
}

</style>
