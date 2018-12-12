<template lang="pug">
  .row
    h1 Mantenimiento de salas
    hr
    .col-12
    router-link.form-group.btn.btn-info(to='/room/create') Nueva Sala
      i(data-feather='plus')
    table.table.table-bordered
      thead
        th Nombre
        th Direccion
        th Opciones
      tbody
        tr(v-for='(item, index) in rooms')
          td {{ item.name }}
          td {{ item.address }}
          td
            router-link(:to='{ path: `/room/${item.id}/edit` }') Editar
</template>

<script>
export default {
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      rooms: [],
    }
  },
  methods: {
    fetchData() {
      this.$http.get('rooms').then(response => {
        console.log(response);
        this.rooms = response.body.rooms;
      }, response => {
        console.log(response);
      });
    }
  }
}
</script>

<style lang="css">
</style>
