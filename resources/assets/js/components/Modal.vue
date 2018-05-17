<template>
  <div class="modal" :id="id" :class="{ 'is-active': show }">
    <div class="modal-background"></div>
    <div class="modal-card"> 
        <div class="modal-card-head">
          <p class="modal-card-title" v-text="title"></p>
          <button type="button" class="delete" aria-label="Close" @click="close">
          </button>
        </div>
        <div class="modal-card-body">
            <slot></slot>
        </div>
        <div class="modal-card-foot">
          <button type="button" class="button is-danger" data-dismiss="modal" @click="active = false">Close</button>
        </div>
    </div>
  </div>
</template>

<script>
export default {

    props: ['id','title', 'active'],

    computed: {

        show() {

          return this.active

        } 

    },

    methods: {

      close() {
      
        this.active = false

      }


    }
}
</script>