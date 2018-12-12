<template lang="html">
  <div class="row">
    <div class="col-12">
      <h1>Salas</h1>
      <select class="custom-select" v-model='currentRoom' @change='pickRoom()'>
        <option :value="{}">Seleccione una sala...</option>
        <option :value="item" v-for='(item, index) in rooms'>{{ item.name }}</option>
      </select>
      <hr>
      <div class="row">
        <div class="col-6">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Posicion</span>
            </div>
            <input class="form-control" placeholder="TurnOver" type="text" readonly>
            <input class="form-control" placeholder="TotalWin" type="text" readonly>
            <input class="form-control" placeholder="Billetes" type="text" readonly>
          </div>
          <form id="listForm">
            <div class="input-group form-group" v-for='(item, index) in machines'>
              <div class="input-group-prepend">
                <span class="input-group-text">{{ item.position }}</span>
              </div>
              <input class="form-control" v-model='item.turnover' placeholder="TurnOver" type="number" min='0' required>
              <input class="form-control" v-model='item.totalwin' placeholder="TotalWin" type="number" min='0' required>
              <input class="form-control" v-model='item.bill' placeholder="Billetes" type="number" min='0' required>
            </div>
          </form>
        </div>
        <div class="col-6">
          <textarea class="form-control form-group" rows="2"
            placeholder="Pege aqui el contendio de su plantilla execel"
            @input='parseText()' v-model='excelText'></textarea>
          <div class="form-row">
            <div class="col-6">
              <button type="button" class="btn btn-danger btn-block">Cancelar</button>
            </div>
            <div class="col-6" v-if='machines.length'>
              <button id='submitButton' type="button" class="btn btn-info btn-block" @click='submit()'>Registrar</button>
            </div>
            <div class="col-6" v-else>
              <button type="button" class="btn btn-info btn-block" disabled>Registrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <accounting-modal @changeState='changeState'></accounting-modal>
  </div>
</template>

<script>
import Icono from '@/components/Icono.vue'
import AccountingModal from '@/components/machine/AccountingModal.vue'
import {mapMutations, mapState} from 'vuex'
export default {
  computed: {
    ...mapState(['machine']),
    fixArray() {
      var newArray =  [];
      this.machines.forEach(item => {
        newArray[item.position-1] =  item;
      });
      return newArray;
    }
  },
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      machines: [],
      rooms: [],
      currentRoom: {},
      excelText: '',
    }
  },
  methods: {
    ...mapMutations([
      'setMachine'
    ]),
    submit() {
      if (listForm.reportValidity()) {
        this.machines.forEach(machine => {
          submitButton.innerHTML = 'Espere...';
          submitButton.disabled = true;
          var count = {
            machine_id: machine.id,
            initialTO: machine.lastTurnover,
            initialTW: machine.lastTotalwin,
            finalTO: machine.turnover,
            finalTW: machine.totalwin,
            initialBill: machine.lastBill,
            finalBill: machine.bill,
            //created_at: this.currentDate,
          };
          this.$http.post('counts', { count: count }).then(response => {
            submitButton.innerHTML = 'Registrar';
            submitButton.disabled = false;
            machine.turnover = '';
            machine.totalwin = '';
            machine.bill = '';
            console.log(response);
          }, response => {
            console.log(response);
          });
        });
        this.$root.$emit('message', 'Registros subidos correctamente!');
      }
    },
    parseText() {
      var rows = this.excelText.split('\n');
      console.log(rows);
      rows.forEach(item => {
        var colums = item.split('\t');
        this.machines.forEach(machine => {
          if (colums[0] == machine.position) {
            machine.turnover = colums[1];
            machine.totalwin = colums[2];
            machine.bill = colums[3];
          }
        })
      });
      this.excelText = '';
    },
    changeState() {
      this.$http.get('machines').then(response => {
        console.log(response);
        this.machines = response.body.machines
      }, response => {
        console.log(response);
      });
    },
    fetchData() {
      this.$http.get('rooms').then(response => {
        console.log(response);
        this.rooms = response.body.rooms;
      }, response => {
        console.log(response);
      });
    },
    pickRoom() {
      this.$http.get(`rooms/${this.currentRoom.id}/withMachines`).then(response => {
        console.log(response);
        this.machines = response.body.room.machines;
      }, response => {
        console.log(response);
      });
    }
  },
  components: {
    Icono,
    AccountingModal
  }
}
</script>

<style lang="css">
</style>
