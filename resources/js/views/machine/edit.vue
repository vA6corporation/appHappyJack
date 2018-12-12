<template lang="html">
  <div class="row">
    <div class="col-12">
      <h1>Editar Equipo</h1>
      <hr>
    </div>
    <div class="col-12">
      <form @submit.prevent='submit()'>
        <div class="form-group">
          <label for="">Nombre de equipo</label>
          <input class="form-control" type="text" v-model='machine.name' required>
        </div>
        <div class="form-group">
          <label for="">Nombre de juego</label>
          <input class="form-control" type="text" v-model='machine.game' required>
        </div>
        <div class="form-group">
          <label for="">Denominacion de moneda</label>
          <select class="custom-select" v-model='machine.denominate' required>
            <option value="0.10">0.10</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Fabricante</label>
          <input class="form-control" type="text" v-model='machine.maker' required>
        </div>
        <div class="form-group">
          <label for="">Serie</label>
          <input class="form-control" type="text" v-model='machine.series' required>
        </div>
        <div class='form-group d-flex justify-content-between'>
          Tiene Contador de billetes?...
          <toggle-button v-model="machine.hasBill"
          :labels="{checked: 'Si', unchecked: 'No'}"
          :sync='true'/>
        </div>
        <div class="form-group">
          <label for="">Posicion</label>
          <input class="form-control" type="text" v-model='machine.position' required>
        </div>
        <div class="form-group">
          <label for="">Numero de maquina</label>
          <input class="form-control" type="text" v-model='machine.number' required>
        </div>
        <div class="form-group">
          <label for="">Sala</label>
          <select class="custom-select" v-model='machine.room_id'>
            <option :value="null" disabled selected>Seleccione una sala...</option>
            <option :value="item.id" v-for='(item, index) in rooms'>{{ item.name }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Ultimos Registros
            <a href="#" data-target='#editModal' data-toggle='modal'>
              Modificar <i data-feather='edit' width='16'></i>
            </a>
          </label>
          <div class="form-row">
            <div class="col-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Turnover</span>
                </div>
                <input class="form-control" type="text" v-model='machine.lastTurnover' disabled required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Totalwin</span>
                </div>
                <input class="form-control" type="text" v-model='machine.lastTotalwin' disabled required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Billetes</span>
                </div>
                <input class="form-control" type="text" v-model='machine.lastBill' disabled required>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="">Observacion</label>
          <textarea class="form-control" rows="2" v-model='machine.observation'></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-info float-right" type="submit" name="button">
            Guardar
            <i data-feather='save'></i>
          </button>
        </div>
      </form>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <form @submit.prevent='submitReg()' class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modificar ultimo registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Turnover</span>
              </div>
              <input class="form-control" type="number" min='0' v-model='machine.lastTurnover' required>
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Totalwin</span>
              </div>
              <input class="form-control" type="number" min='0' v-model='machine.lastTotalwin' required>
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Billetes</span>
              </div>
              <input class="form-control" type="number" min='0' v-model='machine.lastBill' required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancelar <i class="ml-1" data-feather='x'></i>
            </button>
            <button type="submit" class="btn btn-primary">
              Guardar <i class="ml-1" data-feather='save'></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      machine: {},
      rooms: [],
    }
  },
  methods: {
    fetchData() {
      var machineId = this.$route.params.machineId;
      this.$http.get(`machines/${machineId}`).then(response => {
        console.log(response);
        this.machine = response.body.machine;
      }, response => {
        console.log(response);
      });
      this.$http.get('rooms').then(response => {
        console.log(response);
        this.rooms = response.body.rooms;
      }, response => {
        console.log(response);
      });
    },
    submitReg() {
      var reg = {
        lastTurnover: this.machine.lastTurnover,
        lastTotalwin: this.machine.lastTotalwin,
        lastBill: this.machine.lastBill,
      };
      this.$http.post('machines/updateReg', { machine: this.machine }).then(response => {
        $('.modal').modal('hide');
        console.log(response);
      }, response => {
        console.log(response);
      });
    },
    submit() {
      this.$http.put(`machines/${this.machine.id}`, {machine: this.machine}).then(response => {
        this.$root.$emit('message', 'Se han guardado los cambios');
      }, response => {
        console.log(response);
      });
    }
  }
}
</script>

<style lang="css">
</style>
