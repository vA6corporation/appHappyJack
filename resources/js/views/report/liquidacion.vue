<template lang="html">
  <div class="row">
    <div class="col">
      <select class="custom-select form-group"  v-model='currentRoom'>
        <option :value="{}">Seleccione una sala...</option>
        <option v-for='item in rooms' :value="item">{{ item.name }}</option>
      </select>
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#">Liquidacion</a>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to='/report/sala'>Sala</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to='report/relleno'>Relleno</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/report/retiro">Retiro</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/report/pago">Pago Manual</router-link>
            </li>
          </ul>
        </div>
        <div class="card-body" v-if='Object.keys(currentRoom).length'>
          <div class="form-row form-group">
            <label class="col-1 col-form-label">Inicio</label>
            <div class="col-3">
              <div class="input-group">
                <input class="form-control" type="date" v-model='sd'>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i data-feather='calendar' width='18' height='18'></i>
                  </span>
                </div>
              </div>
            </div>
            <label class="col-1 col-form-label">Fin</label>
            <div class="col-3">
              <div class="input-group">
                <input class="form-control" type="date" v-model='ed'>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i data-feather='calendar' width='18' height='18'></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-row">
                <div class="col-6">
                  <button class="btn btn-info btn-block" type="button" @click='find()'>Filtrar</button>
                </div>
                <div class="col-6">
                  <a class="btn btn-success btn-block" target="_blank" @click='setLink($event, $event.target)'>Imprimir</a>
                </div>
                <!-- <div class="col-4">
                  <button class="btn btn-secondary btn-block" type="button" name="button">Salir</button>
                </div> -->
              </div>
            </div>
          </div>
          <table class="table table-striped trable-bordered table-bordered">
            <thead>
              <th>Serie</th>
              <th>Juego</th>
              <th>POS</th>
              <th>CONT. INICIALES <br><small class="text-muted">Turnover - Totalwin</small> </th>
              <th>CONT. FINAL <br><small class="text-muted">Turnover - Totalwin</small></th>
              <th>DIFER.CONT <br><small class="text-muted">Turnover - Totalwin</small></th>
              <th>PRODUCCION</th>
            </thead>
            <tbody>
              <tr v-for='(item, index) in counts'>
                <td>{{ item.machine.series }}</td>
                <td>{{ item.machine.game }}</td>
                <td>{{ item.machine.position }}</td>
                <td>{{ item.initialTO }} - {{ item.initialTW }}</td>
                <td v-if='item.finalTO'>{{ item.finalTO }} - {{ item.finalTW }}</td>
                <td v-else> En conteo</td>
                <td v-if='item.finalTO'>{{ item.finalTO - item.initialTO }} - {{ item.finalTW - item.initialTW }}</td>
                <td v-else> En conteo </td>
                <td v-if='item.finalTO'>{{ dif(item.finalTO - item.initialTO, item.finalTW - item.initialTW) }}</td>
                <td v-else> En conteo </td>
              </tr>
            </tbody>
          </table>
        </div>
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
      currentRoom: {},
      rooms: [],
      sd: '',
      ed: '',
      counts: [],
    }
  },
  methods: {
    fetchData() {
      this.$http.get('rooms').then(response => {
        this.rooms = response.body.rooms;
      });
    },
    setLink(event, el) {
      if (this.sd && this.ed) {
        el.href = `${this.$http.options.root}print/liquidacion/${this.sd}/${this.ed}/${this.currentRoom.id}`;
      } else {
        event.preventDefault();
      }
      console.log(`/print/liquidacion/${this.sd}/${this.ed}`);
    },
    find() {
      this.$http.get(`counts/byDateRange/${this.sd}/${this.ed}/${this.currentRoom.id}`).then(response => {
        console.log(response);
        this.counts = response.body.counts;
      }, response => {
        console.log(response);
      });
    },
    dif(totalwin, turnover) {
      return totalwin - turnover;
    }
  },
  updated() {
    this.$nextTick(function () {
      feather.replace();
    })
  }
}
</script>

<style lang="css">
</style>
