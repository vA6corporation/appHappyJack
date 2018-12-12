<template lang="html">
  <form class="row" @submit.prevent='submit()'>
    <div class="col-12">
      <h1>Edicion de usuario</h1>
      <hr>
    </div>
    <div class="col-12 form-group">
      <div class="form-group">
        <label>Nombres</label>
        <input type="text" class="form-control" v-model='user.name' placeholder="Nombres" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" v-model='user.email' placeholder="Email" required>
      </div>
      <label for="">Permisos</label>
      <div class="row">
        <div class="col-3">
          Archivo
          <toggle-button v-model="user.archive"
          :sync='true'/>
        </div>
        <div class="col-3">
          Consulta
          <toggle-button v-model="user.find"
          :sync='true'/>
        </div>
        <div class="col-3">
          Estadistico
          <toggle-button v-model="user.report"
          :sync='true'/>
        </div>
        <div class="col-3">
          Mantenimiento
          <toggle-button v-model="user.setting"
          :sync='true'/>
        </div>
      </div>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-info">Guardar <i data-feather='save'></i> </button>
    </div>
  </form>
</template>

<script>
export default {
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      user: {}
    }
  },
  methods: {
    fetchData() {
      var userId = this.$route.params.userId;
      this.$http.get(`users/${userId}`).then(response => {
        this.user = response.body.user;
      });
    },
    submit() {
      this.$http.post('users', { user: this.user }).then(response => {
        console.log(response);
        this.$root.$emit('message', 'Se han gauardado los cambios');
      }, response => {
        console.log(respones);
      });
    }
  }
}
</script>

<style lang="css">
</style>
