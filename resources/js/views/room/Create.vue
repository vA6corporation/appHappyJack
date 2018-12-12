<template lang="pug">
  .row
    .col-12
      h1 Nueva Sala
      hr
    .col-12
      form(@submit.prevent='submit()')
        .form-group
          label Nombre de la Sala
          input.form-control(type='text', v-model='room.name' placeholder='Nombre')
        .form-group
          label Direccion
          input.form-control(type='text', v-model='room.address' placeholder='Direccion')
        .form-group.form-check
        button.btn.btn-primary(type='submit') Guardar
          i.ml-1(data-feather='save')
</template>

<script>
export default {
  mounted() {
    // this.fetchData();
  },
  data() {
    return {
      room: {}
    }
  },
  methods: {
    submit() {
      this.$http.post('rooms', { room: this.room }).then(response => {
        console.log(response);
        this.$router.push('/room');
        // this.showMessage('Sala creada correctamente');
      }, response => {
        console.log(response);
      })
    }
  }
}
</script>

<style lang="css">
</style>
