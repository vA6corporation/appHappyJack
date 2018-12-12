<template lang="pug">
  .row
    .col-12
      h1 Editar Sala
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
    this.fetchData();
  },
  data() {
    return {
      room: {}
    }
  },
  methods: {
    fetchData() {
      var roomId = this.$route.params.roomId;
      this.$http.get(`rooms/${roomId}`).then(response => {
        console.log(response);
        this.room = response.body.room;
      }, response => {
        console.log(response);
      })
    },
    submit() {
      this.$http.put(`rooms/${this.room.id}`, { room: this.room }).then(response => {
        console.log(response);
        // this.$router.push('/rooms');
        this.$root.$emit('message', 'Se han guardado los datos');
      }, response => {
        console.log(response);
      })
    }
  }
}
</script>

<style lang="css">
</style>
