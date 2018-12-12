<template lang="html">
  <div class="row">
    <div class="col-12">
      <h1>Nuevo Equipo</h1>
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
          <div class="input-group form-group">
            <select class="custom-select" required v-model='machine.game'>
              <option :value="null">Selecciona un nombre...</option>
              <option v-for='item in games' :value="item.name">{{ item.name }}</option>
            </select>
            <div class="input-group-append">
              <button class="btn btn-info" type="button" name="button"
                data-toggle='modal' data-target='#gameModal'>Agregar Nuevo <i data-feather='plus'></i> </button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="">Fabricante</label>
          <div class="input-group form-group">
            <select class="custom-select" v-model='machine.maker'>
              <option :value="null">Selecciona un fabricante...</option>
              <option v-for='item in factories' :value="item.name">{{ item.name }}</option>
            </select>
            <div class="input-group-append">
              <button class="btn btn-info" type="button" name="button"
                data-toggle='modal' data-target='#factoryModal'>Agregar Nuevo <i data-feather='plus'></i> </button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="">Serie</label>
          <input class="form-control" type="text" v-model='machine.series' required>
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
          <label for="">Denominacion de moneda</label>
          <select class="custom-select" v-model='machine.denominate' required>
            <option value="0.10">0.10</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Sala</label>
          <select class="custom-select" v-model='machine.room_id' required>
            <option :value="null" disabled selected>Seleccione una sala...</option>
            <option :value="item.id" v-for='(item, index) in rooms'>{{ item.name }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Ultimos Registros
            <!-- <a href="#" @click.prevent='edit = true'>
              Modificar <i data-feather='edit' width='16'></i>
            </a> -->
          </label>
          <div class="form-row">
            <div class="col-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Turnover</span>
                </div>
                <input class="form-control" type="number" min='0' v-model='machine.lastTurnover' required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Totalwin</span>
                </div>
                <input class="form-control" type="number" min='0' v-model='machine.lastTotalwin' required>
              </div>
            </div>
            <div class="col-4">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Billetes</span>
                </div>
                <input class="form-control" type="number" min='0' v-model='machine.lastBill'  required>
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
    <div class="modal fade" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form @submit.prevent='submitGame()' class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nuevo juego</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" v-model='game.name' placeholder='Nombre del juego' required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close <i data-feather='x'></i> </button>
            <button type="submit" class="btn btn-primary">Guardar <i data-feather='save'></i> </button>
          </div>
        </form>
      </div>
    </div>
    <div class="modal fade" id="factoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form @submit.prevent='submitFactory()' class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nuevo Fabricante</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="text" class="form-control" v-model='factory.name' placeholder="Nombre del fabricante" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close <i data-feather='x'></i> </button>
            <button type="submit" class="btn btn-primary">Guardar <i data-feather='save'></i> </button>
          </div>
        </form>
      </div>
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
      rooms: [],
      games: [],
      factories: [],
      factory: {},
      game: {},
      edit: false,
      machine: {
        lastTurnover: 0,
        lastTotalwin: 0,
        lastBill: 0,
        room_id: null,
        name: null,
        game: null,
        denominate: '0.10',
        maker: null,
        series: '',
        position: '',
        number: '',
        observation: '',
      }
    }
  },
  methods: {
    fetchData() {
      this.$http.get('rooms').then(response => {
        console.log(response);
        this.rooms = response.body.rooms;
      });
      this.$http.get('games').then(response => {
        console.log(response);
        this.games = response.body.games;
      });
      this.$http.get('factories').then(response => {
        console.log(response);
        this.factories = response.body.factories;
      });
    },
    submit() {
      this.$http.post('machines', { machine: this.machine }).then(response => {
        this.$router.push('/machine');
        this.$root.$emit('message', 'El equipo se ha creado correctamente');
      }, response => {
        console.log(response);
      });
    },
    submitGame() {
      this.$http.post('games', { game: this.game }).then(response => {
        this.fetchData();
        this.machine.game = this.game.name;
        this.game.name = '';
        $('.modal').modal('hide');
        this.$root.$emit('message', 'El juego se ha creado correctamente');
      }, response => {
        console.log(response);
      });
    },
    submitFactory() {
      this.$http.post('factories', { factory: this.factory }).then(response => {
        this.fetchData();
        this.machine.maker = this.factory.name;
        this.factory.name = '';
        $('.modal').modal('hide');
        this.$root.$emit('message', 'El  fabricante se ha creado correctamente');
      }, response => {
        console.log(response);
      });
    }
  }
}
</script>

<style lang="css">
</style>
