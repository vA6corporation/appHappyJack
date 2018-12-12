<template lang="html">
  <div
    unselectable="on"
    onselectstart="return false;"
    onmousedown="return false;"
    class="lead shadow-sm rounded border text-center align-items-center d-flex justify-content-center"
    :class='[state == 0 ? "bg-danger" : null, state == 1 ? "bg-success" : null, state == 2 ? "bg-secondary" : null]'
    @click='pick()'
    style="width:40px; height:40px; cursor: pointer">
    <span v-if='machine'>{{ machine.position }}</span>
    <span v-else></span>
  </div>
</template>

<script>
export default {
  mounted() {
    // this.$on('click', function() { console.log('hola mundo'); })
  },
  props: {
    position: {
      type: Number,
    },
    state: {
      type: Number,
      default: 2,
    },
    machine: {
      type: Object,
      default: null,
    },
  },
  methods: {
    pick() {
      this.$emit("pick", this.machine);
      console.log(this._uid);
    }
  }
}
</script>

<style lang="css">
</style>
