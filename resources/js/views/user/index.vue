<template lang="html">
<div class="row">
  <div class="d-flex justify-content-between col">
    <h1>Usuarios</h1>
    <div class="">
      <a href="/appHappyJack/register" class="btn btn-info">
        Nuevo Usuario
        <i data-feather='plus'></i>
      </a>
    </div>
  </div>
  <hr>
  <table class="table table-bordered">
    <thead>
      <th>Nombres</th>
      <th>Email</th>
      <th>Opciones</th>
    </thead>
    <tbody>
      <tr v-for='(item, index) in users'>
        <td>{{ item.name }}</td>
        <td>{{ item.email }}</td>
        <td> <router-link :to="{ path: `/user/${item.id}/edit` }">Editar</router-link> </td>
      </tr>
    </tbody>
  </table>
</div>
</template>

<script>
export default {
  mounted() {
    this.$http.get('users').then(response => {
      console.log(response);
      this.users = response.body.users;
    }, response => {
      console.log(response);
    })
  },
  data() {
    return {
      users: [],
    }
  }
}
</script>

<style lang="css">
</style>
